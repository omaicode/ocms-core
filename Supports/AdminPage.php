<?php
namespace Modules\Core\Supports;

use AdminAsset;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewParent;
use Modules\Core\Contracts\AdminPage as AdminPageContract;
use Throwable;

class AdminPage implements Renderable, AdminPageContract
{
    protected $title;
    protected $layout;
    protected $body;
    protected $view;
    protected array $breadcrumb = [];

    public function title(string $title)
    {
        $this->title = $title;

        return $this;
    }

    public function layout(string $layout)
    {
        $this->layout = $layout;

        return $this;
    }

    public function body($view, array $data = [])
    {
        if($view instanceof ViewParent || $view instanceof Htmlable || $view instanceof Renderable) {
            $this->body = $view;
        } else {
            $this->body = View::make($view, $data);
        }

        return $this;
    }

    public function breadcrumb(array $breadcrumb)
    {
        $this->breadcrumb = $breadcrumb;

        return $this;
    }

    public function push($name, $content)
    {
        if($content instanceof ViewParent) {
            $content = $content->render();
        } else {
            $content = View::make($content)->render();
        }

        AdminAsset::push($name, $content);

        return $this;
    }

    public function render()
    {
        try {
            $layout     = $this->layout ?: 'core::'.config('core.admin_layout', 'default-master');
            $title      = __($this->title);
            $body       = (!is_string($this->body) && method_exists($this->body, 'render')) ? $this->body->render() : $this->body;
            $breadcrumb = $this->breadcrumb;
            
            return View::make(
                $layout,
                compact('title', 'body', 'breadcrumb')
            );;
        } catch(HttpResponseException $e) {
            throw $e;
        } catch (Throwable $e) {
            Log::error($e);
            abort(500);
        }
    }
}