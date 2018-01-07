<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Response;

class UserController extends Controller
{
  public function __construct()
    {
      $this->content = array();
    }
    public function login()
    {
      if(Auth::attempt(['email' => request('email'), 'password' => request('password')]))
              {
                $user = Auth::user();
                $this->content['token'] =  $user->createToken('Pizza App')->accessToken;$status = 200;
        }
         else
          {
            $this->content['error'] = "未授权";
                         $status = 401;
        }
            return response()->json($this->content, $status);
    }


    public function userDetails()
    {
      //echo Auth::user();
      //return response()->json(['user' => Auth::user(),role=>['admin'],token=>'admin']);
      $userArray=Auth::user()->toArray();
$myuser=Auth::user();
    $myuser->syncRoles(['admin']);
       $roles=$myuser->getRoleNames();
      // echo $roles;
      //return response()->json(['user' => Auth::user()]);
      return response()->json(['user'=>$userArray,'roles'=>$roles,'avatar'=>'http://pimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif']);//应客户端的要求，这里加上了role
    }

    public function setRoles(){
     //  Role::create(['name' => 'admin']);
         Role::create(['guard_name' => 'api','name' => 'teacher']);
      //Permission::create(['guard_name' => 'api','name' => 'edit articles']);

     //return response()->json(['msg'=>'成功加了adminteacher角色']);

//Auth::user()->givePermissionTo('edit articles');

     return 'ok!';
    }
    public function register($data){
      
      {
          return User::create([
              'name' => $data['name'],
              'email' => $data['email'],
              'password' => bcrypt($data['password']),
          ]);
      }
    }
}
