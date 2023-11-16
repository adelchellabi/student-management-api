<?php

namespace App\Packages\Students\Repositories\Eloquent;

use App\Packages\Students\Repositories\RepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Repository implements RepositoryInterface
{
    public function __construct(protected Model $model)
    {
    }

    public function all(): Collection
    {
        try {
            return $this->model->all();
        } catch (Exception $e) {

        }
    }
}
