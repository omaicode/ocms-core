<main>
    <!-- Section -->
    <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center form-bg-image" data-background-lg="{{ adminAsset('core/img/illustrations/signin.svg')}}">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <h1 class="mb-0 h3">{{config('app.name')}}</h1>
                        </div>
                        <form action="{{ route('admin.auth.login.post') }}" method="POST" class="mt-4 @if($errors->any()) was-validated @endif">
                            @csrf
                            <!-- Form -->
                            <div class="form-group mb-4 has-validation">
                                <label for="username">@lang('core::messages.auth.username')</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fas fa-user icon icon-xs text-gray-600"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="@lang('core::messages.auth.username_placeholder')" name="username" id="username" autofocus required>
                                    <div class="invalid-feedback">{{ $errors->first('username') }}</div>
                                </div>  
                            </div>
                            <!-- End of Form -->
                            <div class="form-group">
                                <!-- Form -->
                                <div class="form-group mb-4 has-validation">
                                    <label for="password">@lang('core::messages.auth.password')</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2">
                                            <i class="fas fa-lock icon icon-xs text-gray-600"></i>
                                        </span>
                                        <input type="password" placeholder="@lang('core::messages.auth.password_placeholder')" class="form-control" name="password" id="password" required>
                                        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                    </div>  
                                </div>
                                <!-- End of Form -->
                                <div class="d-flex justify-content-end align-items-top mb-4">
                                    <div><a href="{{route('admin.auth.forgot')}}" class="small text-right">@lang('core::messages.auth.forgot_password')</a></div>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-gray-800">@lang('core::messages.auth.sign_in')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>