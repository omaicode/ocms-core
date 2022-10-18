<?php
namespace Modules\Core\Supports;

use AdminAsset;
use Omaicode\TableBuilder\Builder;

class TableBuilder extends Builder
{
    public function __construct(array $options = [])
    {
        parent::__construct($options);
    }

    protected function beforeRender()
    {
        AdminAsset::addByGroups(config('table_builder.assets', []));        
    }
}