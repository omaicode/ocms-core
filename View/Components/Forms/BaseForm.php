<?php
namespace Modules\Core\View\Components\Forms;
use Illuminate\View\Component;
class BaseForm extends Component
{
    public $action;
    public $method;
    public $multipart;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action = '', $method = 'POST', bool $multipart = false)
    {
        $this->action = $action;
        $this->method = $method;
        $this->multipart = $multipart;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('core::components.forms/baseform');
    }
}
