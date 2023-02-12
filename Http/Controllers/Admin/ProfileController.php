<?php
namespace Modules\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Contracts\AdminPage;
use Modules\Core\Entities\Admin;
use Modules\Form\Form;
use Modules\Media\Support\Uploader;

class ProfileController extends Controller
{
    protected $request;
    protected $page;
    protected $title = 'core::messages.profile';

    public function __construct(Request $request, AdminPage $page)
    {
        $this->request = $request;
        $this->page    = $page;
    }

    public function index()
    {
        $form = $this->form();
        $breadcrumb = [
            [
                'title'  => __('core::messages.profile'), 
                'url'    => route('admin.profile'),
            ]
        ];  

        return $this->page
        ->title($this->title)
        ->breadcrumb($breadcrumb)
        ->body('core::pages.profile.index', compact('form'));
    }

    public function update()
    {
        $user = $this->request->user();
        return $this->form()->update($user->id);
    }

    protected function form()
    {
        $user = $this->request->user();
        $form = new Form(new Admin);        

        $form->title(__('core::messages.profile'));
        $form->setAction(route('admin.profile.update'));
        $form->redirectUrl(route('admin.profile'));

        $form->row(function($form) {
            $form->width(4)->display('id', __('form::messages.id'));
            $form->width(4)->display('created_at', __('form::messages.created_at'))->with(fn() => $this->created_at->format('Y-m-d H:i:s'));
            $form->width(4)->display('username', __('core::messages.admin.username'));
            
            $form->width(6)
                ->text('name', __('core::messages.admin.name'))
                ->placeholder(__('core::messages.admin.name_placeholder'))                
                ->required()
                ->rules('required|min:3|max:30');
                
            $form->text('email', __('core::messages.admin.email'))
                ->placeholder(__('core::messages.admin.email_placeholder'))    
                ->required()
                ->creationRules('required|email|unique:admins,email')
                ->updateRules('required|email|unique:admins,email,{{id}},id');

            $form->width(6)
                ->password('password', __('core::messages.admin.password'))
                ->placeholder(__('core::messages.admin.password_placeholder'))
                ->creationRules('required|min:8|max:30|confirmed')
                ->updateRules('nullable|min:8|max:30|confirmed');

            $form->width(6)
                ->password('password_confirmation', __('core::messages.admin.password_confirm'))
                ->placeholder(__('core::messages.admin.password_confirm_placeholder'));
        });

        $content_2 = __('core::messages.admin.password_help');

        $form->getLayout()->setCustomContent(<<<HTML
        <ul class="ps-3 text-muted">
            <li class="small">{$content_2}</li>
        </ul>
        HTML);

        $form->tools(function($tools) {
            $tools
            ->avatar('avatar', __('core::messages.admin.avatar'))
            ->preview(fn() => $this->model()->avatar_url)
            ->rules('required|file|image|max:3072');
        });

        $form->submitted(function($form) {
            $form->ignore(['password_confirmation', 'avatar']);
        });

        $form->saved(function($form) {
            $model = $form->model();

            if($this->request->hasFile('avatar')) {
                $media = app(Uploader::class)->upload($this->request->avatar);

                if($media->count() > 0) {
                    $model->update(['avatar' => $media[0]->uuid]);
                }
            }
        });
        
        return $form->edit($user->id);        
    }
}