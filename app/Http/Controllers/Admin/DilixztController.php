<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dilixzt;

class DilixztController extends Controller
{
    //
    public function index()
{
    return view('admin/dilixzt/index')->withDilixzts(Dilixzt::all());
}
public function create()
{
    return view('admin/dilixzt/create');
}
public function store(Request $request)
{
    $this->validate($request, [
        'da' => 'required',
        'xzttext' => 'required',
    ]);

    $dilixzt = new Dilixzt;
    $dilixzt->da = $request->get('da');
    $dilixzt->xzttext = $request->get('xzttext');
//    $dilixzt->user_id = $request->user()->id;

    if ($dilixzt->save()) {
        return redirect('admin/dilixzts');
    } else {
        return redirect()->back()->withInput()->withErrors('保存失败！');
    }
}
public function edit($id){
  return view('admin.dilixzt.edit')->with('dilixzt',Dilixzt::find($id));
}
public function update($id){
  $this->validate($request, [
      'da' => 'required',
      'xzttext' => 'required',
  ]);

  $dilixzt = Dilixzt::find($id);

  $dilixzt->da = $request->get('da');
  $dilixzt->xzttext = $request->get('xzttext');
//    $dilixzt->user_id = $request->user()->id;

  if ($dilixzt->save()) {
      return redirect('admin/dilixzts');
  } else {
      return redirect()->back()->withInput()->withErrors('保存失败！');
  }
}

public function destroy($id)
{
    Dilixzt::find($id)->delete();
    return redirect()->back()->withInput()->withErrors('删除成功！');
}
    }
