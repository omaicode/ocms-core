@component('core::email_templates.components.layout')

@lang('core::email.hello')  

@lang('core::email.reset_password.content')

@component('core::email_templates.components.button', ['url'   => $url ?? '#'])
    {{ __('core::email.reset_password.button')}}
@endcomponent

@lang('core::email.reset_password.sub_content')

@endcomponent