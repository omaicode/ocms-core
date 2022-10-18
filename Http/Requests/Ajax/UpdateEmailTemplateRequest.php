<?php
namespace Modules\Core\Http\Requests\Ajax;

use Modules\Core\Facades\Email;
use Modules\Core\Http\Requests\BaseApiRequest;

class UpdateEmailTemplateRequest extends BaseApiRequest
{
    public function rules()
    {
        $templates = Email::all()->keys()->join(',');

        return [
            'template' => 'required|in:'.$templates,
            'content'  => 'required'
        ];
    }
}