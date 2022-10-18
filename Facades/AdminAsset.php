<?php
namespace Modules\Core\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Core\Supports\AdminAsset as SupportsAdminAsset;

class AdminAsset extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return SupportsAdminAsset::class;
    }
}
