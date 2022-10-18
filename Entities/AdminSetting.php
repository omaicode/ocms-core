<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'description'
    ];
}
