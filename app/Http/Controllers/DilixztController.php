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

public function apiCreateDilixzt(Request $request) {
  // 设置验证规则
  $this->validate($request, [
     'xzttext' => 'required',
     'da' => 'required'
   ]);
$Dilixzt=new Dilixzt;
   $Dilixzt->da=$request->input('da');
   $Dilixzt->xzttext=$request->input('xzttext');

   if ($Dilixzt->save()) {
   			return Redirect('/');
   		} else {
   			return Redirect()->back()->withInput()->withErrors('保存失败！');
   		}
}
}
