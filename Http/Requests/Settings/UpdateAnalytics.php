<?php

namespace Modules\Core\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnalytics extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'app_analytics_trackingId' => 'nullable',
            'app_analytics_viewId'  => 'nullable',
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
