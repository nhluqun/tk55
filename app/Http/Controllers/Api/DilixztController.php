<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dilixzt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DilixztController extends Controller
{
    //
    public function __construct()
      {
        $this->content = array();
      }
    public function search(Request $request){
        $requests=$request;
        $pagesize=$request->input('pagesize');

        if (isset($requests['gjz']) )
            $keyword=$requests['gjz'];
        else $keyword='';

        $dilixzts=Dilixzt::where('xzt','like','%'.$keyword.'%')
            ->where(function($query) use($requests) {
                if(isset($requests['keshi']) && $requests['keshi'])
                {
                    $query->where('keshiid', '=', $requests['keshi']);
                }
            })->get();
        return response()->json(['pageDilixzts'=>$dilixzts], 200);

    }
   public function index(Request $request)
      {
                }

    public function store(Request $request) {
      $this->validate($request, [
         'xzt' => 'required',
         'da' => 'required'
       ]);
       $Dilixzt=new Dilixzt;
          $Dilixzt->da=$request->input('da');
          $Dilixzt->xzt=$request->input('xzt');
          $Dilixzt->keshiid=$request->input('keshiid');
          $Dilixzt->tu1url=$request->input('tu1url');
          $Dilixzt->tu2url=$request->input('tu2url');
          $Dilixzt->xzttext=$request->input('xzttext');
            $Dilixzt->tg=$request->input('tg');
        $Dilixzt->a=$request->input('a');
        $Dilixzt->b=$request->input('b');
        $Dilixzt->c=$request->input('c');
        $Dilixzt->d=$request->input('d');
          if ($Dilixzt->save()) {
            $this->content['msg']='成功创建一道选择题';
            $this->content['status']='200';

          }else {
            $this->content['msg']='新建选择题失败！';
            $this->content['status']='501';

          }
      return response()->json($this->content );
}

  public function edit($id){
    $dilixzt= Dilixzt::find($id);
    return response()->json($dilixzt,200);
  }

  public function update(Request $request) {
      $ok = false;
      $msg = '';
      $id=$request->input('id');

      $Dilixzt = Dilixzt::find($id);
    //dd($dilixzt);
      if ($Dilixzt) {
      //   echo $request->input('da');
        $Dilixzt->da=$request->input('da');
        $Dilixzt->xzt=$request->input('xzt');
        $Dilixzt->keshiid=$request->input('keshiid');
        $Dilixzt->tu1url=$request->input('tu1url');
        $Dilixzt->tu2url=$request->input('tu2url');
        $Dilixzt->xzttext=$request->input('xzttext');
          $Dilixzt->tg=$request->input('tg');
          $Dilixzt->a=$request->input('a');
          $Dilixzt->b=$request->input('b');
          $Dilixzt->c=$request->input('c');
          $Dilixzt->d=$request->input('d');
        $ok = $Dilixzt->save();
        if (!$ok) $msg = '更新失敗！';
    } else {
        $msg = '找不到选择题';
    }

    return response()->json(['ok' => $ok, 'msg' => $msg], 200);
}

public function destroy(Request $request,$id)
{
    if(!$request->filled('ids')) {
        return response()->json(array(
            'status' => 2,
            'message' => '缺少参数',
        ));
    }
    $ids = $request->input('ids');
    //echo $ids;
    try {
        DB::transaction(function () use($ids) {
            $del=Dilixzt::destroy($ids);
//                PostsTag::whereIn('post_id', $ids)->delete();
        });

        return response()->json(array(
            'status' => 200,
            //'del'=>$del,
            'message' => '删除成功',
        ));
    }catch (\Exception $exception) {
        Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());

        return response()->json(array(
            'status' => 1,
            'message' => '删除失败',
        ));
    }

}
public function fk(){
        $dilixzts=Dilixzt::all();
       foreach ($dilixzts as $dilixzt) {
//           $str = $dilixzt->xzt;
//           $strall = preg_split('/[\n\r\t\s;&nbsp][ABCD]/', $str);
//           if (count($strall) == 5) {
//               $dilixzt->tg = $strall[0];
//               $dilixzt->a = $strall[1];
//               $dilixzt->b = $strall[2];
//               $dilixzt->c = $strall[3];
//               $dilixzt->d = $strall[4];
//               $dilixzt->save();
           //去空格
           $dilixzt->xzt=preg_replace('/[&nbsp;]/','',$dilixzt->xzt);
           $dilixzt->tg=preg_replace('/[&nbsp;]/','',$dilixzt->tg);
           $dilixzt->a=preg_replace('/[&nbsp;]/','',$dilixzt->a);
           $dilixzt->b=preg_replace('/[&nbsp;]/','',$dilixzt->b);
           $dilixzt->c=preg_replace('/[&nbsp;]/','',$dilixzt->c);
           $dilixzt->d=preg_replace('/[&nbsp;]/','',$dilixzt->d);
           $dilixzt->save();
           }
       }
//    $dilixzt=Dilixzt::find(1426);
//                $str=$dilixzt->xzt;
//           $strall=preg_split('/[\n\r\t\s;&nbsp][ABCD]/',$str);
//           if(count($strall)==5) {
//               $dilixzt->tg = $strall[0];
//               $dilixzt->a = $strall[1];
//               $dilixzt->b = $strall[2];
//               $dilixzt->c = $strall[3];
//               $dilixzt->d = $strall[4];
//               $dilixzt->save();
//           }

  //      }
}
