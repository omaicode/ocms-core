<?php

namespace Modules\Core\Repositories;

use Omaicode\Repository\Eloquent\BaseRepository;
use Omaicode\Repository\Criteria\RequestCriteria;
use Modules\Core\Repositories\AdminActivityRepository;
use Modules\Core\Entities\AdminActivity;
use Modules\Core\Validators\AdminActivityValidator;

/**
 * Class AdminActivityRepositoryEloquent.
 *
 * @package namespace Modules\Core\Repositories;
 */
class AdminActivityRepositoryEloquent extends BaseRepository implements AdminActivityRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminActivity::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
