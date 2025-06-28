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

    public function deleteData($id){
        return $this->repo->delete($id);
    }

}
