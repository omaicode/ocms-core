<?php
namespace Modules\Core\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Core\Supports\Email as SupportsEmail;

class Email extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return SupportsEmail::class;
    }
}
