<?php

namespace App\Services;

use App\Repositories\PostRepository;

class PostService {

    protected $repo;

    public function __construct(PostRepository $postRepository)
    {
        $this->repo = $postRepository;
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
