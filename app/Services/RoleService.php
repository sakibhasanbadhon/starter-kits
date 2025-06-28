<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService {

    protected $repo;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->repo = $roleRepository;
    }

    public function allData($data){
        return $this->repo->get($data);
    }

    public function storeOrUpdateData($requestData){
        return $this->repo->storeOrUpdate($requestData);
    }

    public function deleteData($requestData){
        return $this->repo->delete($requestData);
    }

}
