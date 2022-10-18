<?php

namespace Modules\Core\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Mail\Markdown;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Module;
use Modules\Core\Contracts\AdminPage;
use Modules\Core\Entities\Admin;
use Modules\Core\Entities\AdminActivity;

class DashboardController extends Controller
{
    public function dashboard(AdminPage $page)
    {
        $module = Module::find('Core');
        $total_modules = count(Module::allEnabled());
        $total_admins  = Admin::count();
        $activities    = AdminActivity::with('admin')->latest()->limit(10)->get();
        $changelog     = '';
        $changelog_path = module_path('Core', 'changelog.md');

        if(File::exists($changelog_path)) {
            $changelog = Markdown::parse(File::get($changelog_path));
        }

        return $page
        ->title(__('core::menu.dashboard'))
        ->body('core::pages.dashboard', compact('module', 'total_modules', 'total_admins', 'changelog', 'activities'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('admin.auth.login');
    }
}
