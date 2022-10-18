<?php

namespace Modules\Core\Enums;

use Omaicode\Enum\Enum;

/**
 * @method static static UNKNOWN()
 */
final class ActivityActionEnum extends Enum
{
    const UNKNOWN     = 'unknown';

    public function getText($admin)
    {
        return __('core::enums.'.$this->value, ['name' => $admin->name]);
    }
}
