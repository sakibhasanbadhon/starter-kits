<?php

namespace App\Interfaces;

interface TestimonialInterface {

    public function get($data);
    public function storeOrUpdate($data);
    public function delete($id);
    public function status($id, $status);

}
