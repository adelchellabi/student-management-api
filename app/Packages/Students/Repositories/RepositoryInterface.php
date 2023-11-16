<?php

namespace App\Packages\Students\Repositories;

use Illuminate\Support\Collection;

interface RepositoryInterface
{
    public function all(): Collection;
}
