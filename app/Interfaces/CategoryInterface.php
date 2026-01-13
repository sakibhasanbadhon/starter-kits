<?php

namespace App\Interfaces;

interface CategoryInterface {

    public function get($data);
    public function storeOrUpdate($data);
    public function edit($id);
    public function delete($id);
    public function status($id, $status);

}
