<?php

namespace Modules\Core\Http\Controllers\Admin;

use ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Modules\Core\Contracts\AdminPage;
use Modules\Core\Facades\Email;
use Modules\Core\Http\Requests\Settings\UpdateBackend;
use Modules\Core\Http\Requests\Settings\UpdateAnalytics;
use Modules\Core\Http\Requests\Settings\UpdateEmail;
use Modules\Core\Http\Requests\Settings\UpdateMaintenance;
use Modules\Core\Supports\Config;
use Modules\Core\Supports\Helper;
use Modules\Core\Supports\Media;

class SettingController extends Controller
{
    protected $page;

    public function __construct(AdminPage $page)
    {
        $this->middleware('can:setting.general', ['general', 'updateBackend', 'updateAnalytics', 'updateMaintenance']);
        $this->middleware('can:setting.email', ['email', 'updateEmail']);

        $this->page = $page;
    }

    public function general()
    {
        $breadcrumb = [['title' => __('core::menu.settings'), 'url' => '#'], ['title' => __('core::menu.settings.general'), 'url' => '#']];
        return $this->page
        ->breadcrumb($breadcrumb)
        ->title(__('core::menu.settings.general'))
        ->body('core::pages.settings.general');
    }

    public function email()
    {
        $breadcrumb = [['title' => __('core::menu.settings'), 'url' => '#'], ['title' => __('core::menu.settings.email'), 'url' => '#']];
        return $this->page
        ->breadcrumb($breadcrumb)
        ->title(__('core::menu.settings.email'))
        ->push('modal', 'core::pages.settings.email_modal')
        ->push('scripts', 'core::pages.settings.email_script')
        ->body('core::pages.settings.email');
    }

    public function updateBackend(UpdateBackend $request)
    {
        $data = $request->only([
            'app__language',
            'app__name',
            'app__debug',
            'app__timezone',
            'app__logo',
            'app__favicon'
        ]);
        
        if($request->hasFile('app__logo')) {
            $media = Media::upload($data['app__logo']);
            $data['app__logo'] = $media ? $media['save_path'] : null;
        } else {
            unset($data['app__logo']);
        }

        if($request->hasFile('app__favicon')) {
            $media = Media::upload($data['app__favicon']);
            $data['app__favicon'] = $media ? $media['save_path'] : null;
        } else {
            unset($data['app__favicon']);
        }

        $data['app__debug'] = @$data['app__debug'] == 'on' ? true : false;
        $data['app__cache'] = @$data['app__cache'] == 'on' ? true : false;

        Config::set($data);

        return redirect()->back()->with('toast_success', __('core::messages.saved'));
    }

    public function updateAnalytics(UpdateAnalytics $request)
    {
        $data = $request->only([
            'analytics__tracking_id',
            'analytics__view_id',
            'analytics__service_account_credentials_json',
        ]);

        Config::set($data);

        return redirect()->back()->with('toast_success', __('core::messages.saved'));
    }

    public function updateMaintenance(UpdateMaintenance $request)
    {
        $data = $request->only([
            'app__maintenance',
        ]);

        $data['app__maintenance'] = @$data['app__maintenance'] == 'on' ? true : false;

        Config::set($data);

        return redirect()->back()->with('toast_success', __('core::messages.saved'));
    }

    public function updateEmail(UpdateEmail $request)
    {
        $data = $request->input();
        $data['mail__queue'] = @$data['mail__queue'] == 'on' ? true : false;
        $data['mail__enable'] = @$data['mail__enable'] == 'on' ? true : false;

        Config::set($data);

        return redirect()->back()->with('toast_success', __('core::messages.saved'));
    }

    public function getEmailTemplate(Request $request)
    {
        $template = Email::get($request->template);

        if(!$request->filled('template') || !$template) {
            return ApiResponse::error(__('core:messages.ajax_email_template_error'));
        }

        if($template['type'] == 'view') {
            $template['content'] = Helper::getRawView($template['content'])['content'];
        }

        return ApiResponse::success()->data($template);
    }
}
