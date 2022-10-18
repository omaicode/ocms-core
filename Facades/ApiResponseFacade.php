<?php
namespace Modules\Core\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Core\Supports\ApiResponse as SupportsApiResponse;

class ApiResponseFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return SupportsApiResponse::class;
    }
}
