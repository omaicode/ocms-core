<div class="row my-4">
    <div class="col-12 col-sm-6 col-xl-4 mb-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-3 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-success rounded me-4 me-sm-0">
                            <svg class="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                        </div>
                        <div class="d-sm-none">
                            <h2 class="h5">@lang('core::messages.dashboard.total_admins')</h2>
                            <h3 class="fw-extrabold mb-1">{{ $total_admins }}</h3>
                        </div>
                    </div>
                    <div class="col-12 col-xl-9 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-gray-400 mb-0">@lang('core::messages.dashboard.total_admins')</h2>
                            <h3 class="fw-extrabold mb-2">{{ $total_admins }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mb-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-3 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-warning rounded me-4 me-sm-0">
                            <svg class="icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="1.13em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 576 512"><path fill="currentColor" d="m290.8 48.6l78.4 29.7l-81.2 31.2l-81.2-31.2l78.4-29.7c1.8-.7 3.8-.7 5.7 0zM136 92.5v112.2c-1.3.4-2.6.8-3.9 1.3l-96 36.4C14.4 250.6 0 271.5 0 294.7v119.2c0 22.2 13.1 42.3 33.5 51.3l96 42.2c14.4 6.3 30.7 6.3 45.1 0L288 457.5l113.5 49.9c14.4 6.3 30.7 6.3 45.1 0l96-42.2c20.3-8.9 33.5-29.1 33.5-51.3V294.7c0-23.3-14.4-44.1-36.1-52.4l-96-36.4c-1.3-.5-2.6-.9-3.9-1.3V92.5c0-23.3-14.4-44.1-36.1-52.4L308 3.7c-12.8-4.8-26.9-4.8-39.7 0l-96 36.4C150.4 48.4 136 69.3 136 92.5zm256 118.1l-82.4 31.2v-89.2L392 121v89.6zm-237.2 40.3l78.4 29.7l-81.2 31.1l-81.2-31.1l78.4-29.7c1.8-.7 3.8-.7 5.7 0zm18.8 204.4V354.8l82.4-31.6v95.9l-82.4 36.2zm247.6-204.4c1.8-.7 3.8-.7 5.7 0l78.4 29.7l-81.3 31.1l-81.2-31.1l78.4-29.7zm102 170.3l-77.6 34.1V354.8l82.4-31.6v90.7c0 3.2-1.9 6-4.8 7.3z"/></svg>                        
                        </div>
                        <div class="d-sm-none">
                            <h2 class="h5">@lang('core::messages.dashboard.total_modules')</h2>
                            <h3 class="fw-extrabold mb-1">{{ $total_modules }}</h3>
                        </div>
                    </div>
                    <div class="col-12 col-xl-9 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-gray-400 mb-0">@lang('core::messages.dashboard.total_modules')</h2>
                            <h3 class="fw-extrabold mb-2">{{ $total_modules }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mb-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-3 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-info rounded me-4 me-sm-0">
                            <svg class="icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><g fill="currentColor"><path d="M5.507 4.048A3 3 0 0 1 7.785 3h8.43a3 3 0 0 1 2.278 1.048l1.722 2.008A4.533 4.533 0 0 0 19.5 6h-15c-.243 0-.482.02-.715.056l1.722-2.008Z"/><path fill-rule="evenodd" d="M1.5 10.5a3 3 0 0 1 3-3h15a3 3 0 1 1 0 6h-15a3 3 0 0 1-3-3Zm15 0a.75.75 0 1 1-1.5 0a.75.75 0 0 1 1.5 0Zm2.25.75a.75.75 0 1 0 0-1.5a.75.75 0 0 0 0 1.5ZM4.5 15a3 3 0 1 0 0 6h15a3 3 0 1 0 0-6h-15Zm11.25 3.75a.75.75 0 1 0 0-1.5a.75.75 0 0 0 0 1.5ZM19.5 18a.75.75 0 1 1-1.5 0a.75.75 0 0 1 1.5 0Z" clip-rule="evenodd"/></g></svg>
                        </div>
                        <div class="d-sm-none">
                            <h2 class="h5">@lang('core::messages.dashboard.cms_version')</h2>
                            <h3 class="fw-extrabold mb-1">{{ $module->get('version', '1.0.0') }}</h3>
                        </div>
                    </div>
                    <div class="col-12 col-xl-9 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-gray-400 mb-0">@lang('core::messages.dashboard.cms_version')</h2>
                            <h3 class="fw-extrabold mb-2">{{ $module->get('version', '1.0.0') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-6 col-lg-6 mb04">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">@lang('core::messages.dashboard.recent_activities')</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tbody>
                        @forelse($activities as $activity)
                            <tr>
                                <td>{!! $activity->action_text !!}</td>
                                <td>{!! $activity->created_at->format('Y-m-d H:i:s') !!}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">@lang('core::messages.dashboard.no_activities')</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-6 col-lg-6 mb04">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">@lang('core::messages.dashboard.changelog')</h5>
            </div>
            <div class="card-body">
                {!! $changelog !!}
            </div>
        </div>
    </div>
</div>