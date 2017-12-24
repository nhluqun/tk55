<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dilixzt;

class DilixztController extends Controller
{
    //
    public function create() {
  return view('dilixzt.create');
}
public function save(Request $request) {
  // 设置验证规则
  $this->validate($request, [
     'xzttext' => 'required',
     'da' => 'required'
   ]);
$Dilixzt=new Dilixzt;
   $Dilixzt->da=Input::get('da');
   $Dilixzt->xzttext=Input::get('xzttext');

   if ($Dilixzt->save()) {
   			return Redirect::to('/');
   		} else {
   			return Redirect::back()->withInput()->withErrors('保存失败！');
   		}
}
}
