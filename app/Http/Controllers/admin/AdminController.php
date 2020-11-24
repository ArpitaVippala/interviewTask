<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\BasicTrait;
use App\UsersModel;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
use Session;
use Cache;

class AdminController extends Controller{
    
    use BasicTrait;

    public function dashboard(){
        return view('admin.dashboard');
    }

    public function createNew(){
        $emps = DB::table('employees')->get();
        return view('admin.createEmp', array('data'=>$emps));
    }

    public function createUserAjax(Request $req){
        if(!empty($req->all())){
            // print_r($req->all());
            $res = Validator::make($req->all(), [
                'username' => ['required', 'string', 'max:255'],
                'emailId' => ['required', 'string', 'email', 'max:255'],
                'mobile'=>['required', 'numeric', 'digits:10'],
                'designation' =>['required'],
                'salary'=>['required', 'numeric']
            ]);
            // dd($res->errors());
            if($res->fails()){
                echo "ERROR1";
            }
            else{
                $empId = DB::table('employees')
                        ->insertGetId(['empName'=>$req->username, 'empEmail'=>$req->emailId, 'empMobile'=>$req->mobile,
                        'empDesg'=>$req->designation, 'empSalary'=>$req->salary, 'created_at'=>date('Y-m-d H:i:s')]) ;      
                if(!empty($empId)){
                    echo "SUCCESS";
                }else{
                    echo "ERROR";
                }                        
            }
        }
    }

    public function salary(){
        return view('admin.salary');
    }

    public function AdminDashboard(){
        return view('admin.adminDashboard');
    }

    public function salaryCal(Request $req){
        if(!empty($req->all())){
            // print_r($req->all());die();
            $salary = "10000";
            $workingDays = $req->workingDays;
            $absentDays = $req->absentDays;
            $lateDays = $req->lateDays;
            $earlyDays = $req->earlyDays;
            $calDays = ($workingDays>0)?$workingDays:0;

            if($calDays > 0){
                
                if($absentDays > 0){
                    $calDays = $calDays - $absentDays;
                }

                if($lateDays > 2){
                    $calDays = $calDays-1;
                }

                if($earlyDays >10){
                    $calDays = $calDays+1;
                }
            }else{
                $calDays =0;
            }
            $calSalary =  ($salary/31)* $calDays;
            $calSalary = number_format($calSalary, 2);
            echo json_encode(array('status'=>'success', 'calculatedSalary'=>$calSalary));          
        }
    }

    public function logout(Request $req){
        if($req->role){
            if($req->role == 'user'){
                session('user')['role'] = '';
            }else if($req->role == 'admin'){
                session('admin')['role'] = '';
            }
            return redirect()->route('Login');
        }
        /*Auth::logout();
        Session::flush();
        cache::flush();
        return redirect()->route('Login');*/
    }
}
