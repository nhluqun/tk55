<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dilixzt;

class DilixztController extends Controller
{
    //
    public function __construct()
      {
        $this->content = array();
      }
      public function index(Request $request){
        $keyword=$request->input('keyword');
        $pagesize=$request->input('pagesize');
        $dilixzts=Dilixzt::where('xzt','like','%'.$keyword.'%')->paginate($pagesize);
        //$totalCount=Dilixzt::All()->Count();
          return response()->json(['pageDilixzts'=>$dilixzts], 200);
      }

    public function create(Request $request) {
      $this->validate($request, [
         'xzttext' => 'required',
         'da' => 'required'
       ]);
       $Dilixzt=new Dilixzt;
          $Dilixzt->da=$request->input('da');
          $Dilixzt->xzttext=$request->input('xzttext');

          if ($Dilixzt->save()) {
            $this->content['msg']='成功创建一道选择题';
              $status='200';
          }else {
            $this->content['msg']='新建选择题失败！';
            $status='501';
          }
      return response()->json($this->content, $status);
}

public function edit($id){
$dilixzt= Dilixzt::find($id);
  return response()->json($dilixzt,200);
}
}
