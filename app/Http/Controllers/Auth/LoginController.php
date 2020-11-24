<?php

namespace App\Http\Controllers\Auth;

use App\UsersModel;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;
use Cache;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(){
        return view('login');
    }

    public function loginUser(Request $req){
        if(!empty($req->all())){
            // print_r($req->all());die();
            $validator = Validator::make($req->all(), [
                'emailId'=> ['required', 'string', 'email', 'max:255'],
                'pwd'=> ['required', 'string', 'min:8'],
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator);
            }else{
                $user = DB::table('users')
                ->select('userId', 'role')
                ->where(['emailId'=>$req->emailId, 'pwd'=>$req->pwd])
                ->get();
                if(!empty($user)){
                    // print_r($user);die();
                    if($user[0]->role == 'user'){
                        Session::put('user', ['userId'=>$user[0]->userId, 'role'=>'user']);
                        if(isset($req->remeberMe)){
                            setcookie('login_email', $req->emailId);
                            setcookie('login_pwd', $req->pwd);                
                        }else{
                            setcookie('login_email', '');
                            setcookie('login_pwd', '');
                        }
                        return redirect()->route('Dashboard');
                    }else if($user[0]->role == 'admin'){
                        Session::put('admin', ['userId'=>$user[0]->userId, 'role'=>'admin']);
                        if(isset($req->remeberMe)){
                            setcookie('login_email', $req->emailId);
                            setcookie('login_pwd', $req->pwd);                
                        }else{
                            setcookie('login_email', '');
                            setcookie('login_pwd', '');
                        }
                        return redirect()->route('AdminDashboard');
                    }                
                }
            }
        }
    }
}
