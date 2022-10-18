<?php

namespace Modules\Core\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBackend extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'app_name'      => 'required|alpha_dash|alpha_num',
            'app_language'  => 'required|in:en,vi',
            'app_timezone'  => 'required',
            'app_debug'     => 'nullable|in:on,off',
            'app_cache'     => 'nullable|in:on,off',
            'app_logo'      => 'nullable|file|image|max:3072',
            'app_favicon'   => 'nullable|file|image|max:3072',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
