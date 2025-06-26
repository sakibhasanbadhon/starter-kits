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

}
