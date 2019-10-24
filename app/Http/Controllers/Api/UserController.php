<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Students;
use Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
  public function __construct()
    {
      $this->content = array();
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
          //  'password' => 'required|string|min:6|confirmed',
            'password' => 'required|string|min:6|confirmed',
        ]);
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
  //    $myuser->syncRoles(['admin']);
  //     $roles=$myuser->getRoleNames();
      // echo $roles;
      //return response()->json(['user' => Auth::user()]);
      //获取该用户的角色（可以是多个）
$roles = $myuser->getRoleNames();
//echo $roles;
      return response()->json(['user'=>$userArray,'roles'=>$roles,'avatar'=>'']);//应客户端的要求，这里加上了role
    }

    public function setRoles(){
       Role::create(['guard_name' => 'api','name' => 'admin']);
        // Role::create(['guard_name' => 'api','name' => 'teacher']);
      //Permission::create(['guard_name' => 'api','name' => 'edit articles']);

     //return response()->json(['msg'=>'成功加了adminteacher角色']);

//Auth::user()->givePermissionTo('edit articles');

     return 'ok!';
    }

    public function Aregister(Request $request){

      {

         $this->validator($request->all())->validate();
//return 'come in';
//         // event(new Registered($user = $this->create($request->all())));
//         //
//         // $this->login($user);
//         //
//         // return $this->registered($request, $user)
//         //                 ?: redirect($this->redirectPath());
//echo '验证通过';
//echo $request->all();
         if($user=$this->create($request->all())){
      //   var_dump( $user);
$this->content['msg']='成功创建用户！';
$status='200';
          return response()->json($this->content, $status);
}
    }
    }

public function queryUserByName(Request $request){
  $this->content['hasname']='no';
 // echo $request->input('name');
    $data=User::where('name','=',$request->input('name'))->get();
   //var_dump($data);
   // echo $data->first();

  if(!$data->isEmpty()){  //如果不为空
    $this->content['hasname']='yes';
   // echo 'yes';
    }
  else {
    # code...
    $this->content['hasname']='no';
    }
  $status='200';
  return response()->json($this->content,$status);
}

    protected function create(array $data)
    {
    //  echo 'create';
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

}
