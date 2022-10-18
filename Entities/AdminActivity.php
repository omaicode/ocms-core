<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Enums\ActivityActionEnum;

class AdminActivity extends Model
{
    protected $fillable = [
        'admin_id',
        'action',
        'agent',
        'ip_address'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'action'     => ActivityActionEnum::class
    ];

    protected $appends = [
        'action_text'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id')->select([
            'id',
            'name'
        ]);
    }

    public function getActionTextAttribute()
    {
        if(!$this->action) {
            return 'Unknown';
        }

        return $this->action->getText($this->admin);
    }
}
