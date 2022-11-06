<?php
namespace Modules\Core\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\Core\Contracts\AdminPage;
use Modules\Form\Controllers\FormBuilderController as BaseController;

class FormBuilderController extends BaseController
{
    use AuthorizesRequests;

    protected array $breadcrumb = [];
    protected $title = '';

    protected function index()
    {

    }

    protected function show($id)
    {
        return app(AdminPage::class)
        ->title($this->title)
        ->breadcrumb($this->breadcrumb)
        ->body($this->form()->edit($id));
    }

    protected function edit($id)
    {
        $breadcrumb = $this->breadcrumb;
        $breadcrumb[] = [
            'title' => __('form::messages.edit'),
            'url'   => '#'
        ];
        $breadcrumb[] = [
            'title' => "#".$id,
            'url'   => request()->url()
        ];
        $this->form()->title(__('form::messages.edit').' #'.$id);

        return app(AdminPage::class)
        ->title(' #'.$id.' | '.$this->title())
        ->breadcrumb($breadcrumb)
        ->body($this->form()->edit($id));
    }

    protected function create()
    {
        $breadcrumb = $this->breadcrumb;
        $breadcrumb[] = [
            'title' => __('form::messages.create'),
            'url'   => request()->url()
        ];

        $this->form()->title(__('form::messages.create'));

        return app(AdminPage::class)
        ->title(__('form::messages.create').' | '.$this->title())
        ->breadcrumb($breadcrumb)
        ->body($this->form());
    }
}