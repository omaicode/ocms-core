<?php
namespace Modules\Core\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Core\Supports\Menu as SupportsMenu;

class Menu extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return SupportsMenu::class;
    }
}
