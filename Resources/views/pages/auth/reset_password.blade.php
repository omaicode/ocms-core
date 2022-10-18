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
                        <form action="{{ route('admin.auth.reset.post', ['token' => request()->route('token')]) }}" method="POST" class="mt-4 @if($errors->any()) was-validated @endif">
                            @csrf
                            <x-forms::group
                                type="password"
                                :label="__('core::messages.auth.new_password')"
                                name="password" 
                                :placeholder="__('core::messages.auth.new_password_placeholder')"
                                :required="true"
                            />    
                            <x-forms::group
                                type="password"
                                :label="__('core::messages.auth.new_password_confirmation')"
                                name="password_confirmation" 
                                :placeholder="__('core::messages.auth.new_password_confirmation_placeholder')"
                                :required="true"
                            />    
                            <div class="d-grid">
                                <button type="submit" class="btn btn-gray-800">@lang('core::messages.auth.reset_password')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>