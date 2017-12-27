<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class PostController extends Controller
{
function index(){
   return view('post');
}

public function apiAll(){
  return response()->json(Post::all(), 200);
}

  /**
   * 取得單一文章
   */
  function apiFindPostById($id) {
      return response()->json(Post::find($id), 200);
  }

  /**
   * 建立一篇文章
   */
  function apiCreatePost(Request $request) {
      $post = new Post;
      $post->title = $request->input('title', '沒有標題');
      $post->body = $request->input('body', '沒有內文。');
      $ok = $post->save();

      return response()->json(['ok' => $ok], 200);
  }

  /**
   * 更新一篇文章
   */
  function apiUpdatePostById(Request $request, $id) {
      $ok = false;
      $msg = '';
      //
      $post = Post::find($id);
      if ($post) {
          $post->title = $request->input('title', '沒有標題');
          $post->body = $request->input('body', '沒有內文。');
          $ok = $post->save();
          if (!$ok) $msg = '更新失敗！';
      } else {
          $msg = '找不到文章';
      }

      return response()->json(['ok' => $ok, 'msg' => $msg], 200);
  }

  /**
   * 刪除一篇文章
   */
  function apiDeletePostById($id) {
      $rows = Post::destroy($id);
      $ok = ($rows > 0);
      return response()->json(['ok' => $ok], 200);
  }
}
