<?php

namespace App\Interfaces;

interface RoleInterface {

    public function get($data);
    public function storeOrUpdate($data);
    public function delete($data);

}
