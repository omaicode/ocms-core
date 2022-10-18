<?php
namespace Modules\Core\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\Core\Contracts\AdminPage;
use Omaicode\FormBuilder\Controllers\FormBuilderController as BaseController;

class FormBuilderController extends BaseController
{
    use AuthorizesRequests;

    protected array $breadcrumb = [];

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
        return app(AdminPage::class)
        ->title($this->title)
        ->breadcrumb($this->breadcrumb)
        ->body($this->form()->edit($id));
    }

    protected function create()
    {
        return app(AdminPage::class)
        ->title($this->title)
        ->breadcrumb($this->breadcrumb)
        ->body($this->form());
    }
}