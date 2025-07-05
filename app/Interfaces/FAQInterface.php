<?php

namespace App\Interfaces;

interface FAQInterface {

    public function get($data);
    public function storeOrUpdate($data);
    public function delete($id);
    public function status($id, $status);

}
