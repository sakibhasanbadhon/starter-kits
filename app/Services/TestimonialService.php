<?php

namespace App\Services;

use App\Repositories\TestimonialRepository;

class TestimonialService {

    protected $repo;

    public function __construct(TestimonialRepository $testimonialRepository)
    {
        $this->repo = $testimonialRepository;
    }

    public function allData($data){
        return $this->repo->get($data);
    }

    public function storeOrUpdateData($requestData){
        return $this->repo->storeOrUpdate($requestData);
    }

    public function deleteData(int $id){
        return $this->repo->delete($id);
    }

    public function statusData(int $id, int $status){
        return $this->repo->status($id, $status);
    }
}
