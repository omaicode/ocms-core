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
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                        @else
                        <form action="{{ route('admin.auth.forgot.post') }}" method="POST" class="mt-4 @if($errors->any()) was-validated @endif">
                            @csrf
                            <!-- Form -->
                            <div class="form-group mb-4 has-validation">
                                <label for="email">@lang('core::messages.auth.email')</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fas fa-envelope icon icon-xs text-gray-600"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="@lang('core::messages.auth.email_placeholder')" name="email" id="email" value="{{old('email', '')}}" autofocus required>
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                </div>  
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-gray-800">@lang('core::messages.auth.reset_password')</button>
                            </div>
                        </form>
                        @endif
                        <div class="d-flex justify-content-center align-items-top mt-4">
                            <div>
                                <a href="{{ route('admin.auth.login') }}" class="small text-right">
                                    <i class="fas fa-chevron-left"></i>
                                    @lang('core::messages.auth.back_to_login')
                                </a>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>