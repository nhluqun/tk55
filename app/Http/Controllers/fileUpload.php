<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class fileUpload extends Controller
{
  public function upload(Request $request){
    if($request->isMethod('post')){
                $all = $request->all();
                $rules = [
                    'upFile'=>'required',
                ];
                $messages = [
                    'upFile.required'=>'请选择要上传的文件'
                ];
                $validator = Validator::make($all,$rules,$messages);
                if($validator->fails()){
                    return back()->withErrors($validator);
                }
                //获取上传文件的大小
                $size = $request->file('upFile')->getSize();
                //这里可根据配置文件的设置，做得更灵活一点
                if($size > 2*1024*1024){
                    return back()->with('errors','上传文件不能超过2M');
                }
                //文件类型
                $mimeType = $request->file('upFile')->getMimeType();
                //这里根据自己的需求进行修改
                if($mimeType != 'image/png'){
                    return back()->with('errors','只能上传png格式的图片');
                }
                //扩展文件名
                $ext = $request->file('upFile')->getClientOriginalExtension();
                //判断文件是否是通过HTTP POST上传的
                $realPath = $request->file('upFile')->getRealPath();

                if(!$realPath){
                    return back()->with('errors','非法操作');
                }

                //创建以当前日期命名的文件夹
                $today = date('Y-m-d');
                //storage_path().'/app/uploads/' 这里根据 /config/filesystems.php 文件里面的配置而定
                //$dir = str_replace('\\','/',storage_path().'/app/uploads/'.$today);
                $dir = storage_path().'/app/uploads/'.$today;
                if(!is_dir($dir)){
                    mkdir($dir);
                }

                //上传文件
                $filename = uniqid().'.'.$ext;//新文件名
                if(Storage::disk('uploads')->put($today.'/'.$filename,file_get_contents($realPath))){
                    dd('上传成功');
                }else{
                    dd('上传失败');
                }
            }else{
                return view('test.index');
            }
        }
  }
}
