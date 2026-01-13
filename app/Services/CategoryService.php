<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService {

    protected $repo;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->repo = $categoryRepository;
    }

    public function allData($data){
        return $this->repo->get($data);
    }

    public function storeOrUpdateData($requestData){
        return $this->repo->storeOrUpdate($requestData);
    }

    public function editData(int $id){
        return $this->repo->edit($id);
    }

    public function deleteData(int $id){
        return $this->repo->delete($id);
    }

    public function statusData(int $id, int $status){
        return $this->repo->status($id, $status);
    }
}
