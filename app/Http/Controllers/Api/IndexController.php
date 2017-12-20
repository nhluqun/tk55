<?php

namespace App\Http\Controllers\Api;
use App\Students;
use App\Http\Resources\Student as StudentResource;
class IndexController extends ApiController
{
    public function index(){

      //  return $this->message('请求成功');
      return new StudentResource(Students::find(1));
    }
}
