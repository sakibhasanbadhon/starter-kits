<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService {

    protected $repo;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->repo = $roleRepository;
    }

    public function storeOrUpdateData($requestData){
        return $this->repo->storeOrUpdate($requestData);
    }

}
