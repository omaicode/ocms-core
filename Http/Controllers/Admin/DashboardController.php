<?php

namespace Modules\Core\Http\Controllers\Admin;

use AdminAsset;
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
use Illuminate\Support\Facades\Log;
use Modules\Core\Facades\AnalyticsFacade;
use Modules\Core\Supports\Period;
use Throwable;

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
        $analytics     = collect([]);

        if(File::exists($changelog_path)) {
            $changelog = Markdown::parse(File::get($changelog_path));
        }
        
        try {
            $analytics = AnalyticsFacade::fetchTotalVisitorsAndPageViews(Period::days(30));
        }catch(Throwable $e) {
            Log::error($e);
        }
        
        AdminAsset::addScript('chartjs', asset('vendor/chartjs/chart.umd.js'));
        AdminAsset::push('scripts', view('core::components.dashboard_script', compact('analytics')));

        return $page
        ->title(__('core::menu.dashboard'))
        ->body('core::pages.dashboard', compact('module', 'total_modules', 'total_admins', 'changelog', 'activities', 'analytics'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('admin.auth.login');
    }
}
