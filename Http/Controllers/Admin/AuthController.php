<?php

namespace Modules\Core\Http\Controllers\Admin;

use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\Core\Contracts\AdminPage;
use Modules\Core\Entities\Admin;
use Modules\Core\Facades\Email;
use Modules\Core\Http\Requests\ForgotPasswordRequest;
use Modules\Core\Http\Requests\ResetPasswordRequest;
use Modules\Core\Http\Requests\SignInRequest;

class AuthController extends Controller
{
    public function login(AdminPage $page)
    {
        return $page
        ->layout('core::default-blank')
        ->title(__('core::messages.auth.sign_in'))
        ->body('core::pages.auth.login');
    }

    public function forgot(AdminPage $page)
    {
        return $page
        ->layout('core::default-blank')
        ->title(__('core::messages.auth.forgot_password'))
        ->body('core::pages.auth.forgot_password');
    }

    public function reset(AdminPage $page, $token)
    {
        $reset = DB::table('admin_password_resets')
        ->where('token', $token)
        ->first();

        if(!$reset) {
            return redirect()->route('admin.auth.login')->with('toast_error', __('core::messages.auth.reset_invalid'));
        } else if(Carbon::parse($reset->created_at)->diffInMinutes(Carbon::now()) > 30) {
            return redirect()->route('admin.auth.login')->with('toast_error', __('core::messages.auth.reset_invalid'));
        }

        return $page
        ->layout('core::default-blank')
        ->title(__('core::messages.auth.reset_password'))
        ->body('core::pages.auth.reset_password');
    }

    public function postLogin(SignInRequest $request)
    {
        if(!Auth::attempt($request->only(['username', 'password']))) {
            return redirect()->back()->withErrors(['username' => [__('auth.failed')]]);
        }
        
        Admin::where('username', $request->username)->update([
            'last_login_at' => now()
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function postForgot(ForgotPasswordRequest $request)
    {
        $has_prev_token = DB::table('admin_password_resets')
        ->where('email', $request->email)
        ->whereRaw('ABS(TIMESTAMPDIFF(minute, created_at, NOW())) <= 5')
        ->exists();

        if($has_prev_token) {
            return redirect()->back()->withErrors(['email' => [__('core::messages.auth.reset_limit')]]);
        }

        $token = (string)Str::uuid();
        $url   = route('admin.auth.reset', ['token' => $token]);

        try {
            DB::beginTransaction();
            DB::table('admin_password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => now()
            ]);
            
            Email::send(
                'reset_password',
                $request->email,
                compact('url')
            );
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);
            return redirect()->back()->withErrors(['email' => [__('core::messages.email_error')]]);
        }

        return redirect()->back()->withSuccess(__('core::messages.auth.reset_sent'));
    }

    public function postReset(ResetPasswordRequest $request, $token)
    {
        $reset = DB::table('admin_password_resets')
        ->where('token', $token)
        ->first();

        if(!$reset) {
            return redirect()->route('admin.auth.login')->with('toast_error', __('core::messages.auth.reset_invalid'));
        } else if(Carbon::parse($reset->created_at)->diffInMinutes(Carbon::now()) > 30) {
            return redirect()->route('admin.auth.login')->with('toast_error', __('core::messages.auth.reset_invalid'));
        }
        
        try {
            $admin = Admin::where('email', $reset->email)->firstOrFail();
            $admin->password = $request->password;
            $admin->save();

            DB::table('admin_password_resets')->where('email', $reset->email)->delete();

            return redirect()->route('admin.auth.login')->with('toast_success', __('core::messages.auth.reset_password_success'));
        } catch (Exception $e) {
            return redirect()->back()->with('toast_error', $e->getMessage());
        }
    }
}
