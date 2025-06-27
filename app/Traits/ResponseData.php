<?php

namespace App\Traits;

trait ResponseData {

    public function responseJson($status, $message = null, $data = null, $statusCode = 200) {
        return response()->json([
            'status'  => $status,
            'message' => $message,
            'data'    => $data
        ], $statusCode);
    }

}
