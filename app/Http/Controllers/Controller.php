<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

     /**
     * blade title share
     * @param $title
     * @return \Illuminate\Http\Response
     */
    protected function setPageTitle($title='',$metaTitle='',$metaDesc='',$ogImage = '',$metaKey='')
    {
        view()->share(['title' => $title,'metaTitle'=>$metaTitle,'metaDesc'=>$metaDesc,'ogImage'=>$ogImage,'metaKey'=>$metaKey]);
    }
}
