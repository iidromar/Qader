<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CompanyAdmin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CompanyAdminController extends Controller
{

   public function index(){
       return view('CompanyAdmin.dashboard');
   }
   public function all_employees(){
       $emp = User::where('code', '=', auth()->user()->code)->where('role', '=', '0')->get();
       return view('CompanyAdmin.company_employees', compact('emp'));
   }
   public function employee_progress($id=null){
       $temp = DB::table('course_taken_by')->where('employee_id', '=', $id)->get();
       $cc = [];
       if($temp){
//           foreach ($temp as $t){
//               $cc = $cc + $t->course_id;
//           }
//           foreach($temp as $key => $value)
//           {
//               $cc = array_add($temp, $key, $value);
//           }
       }

       dd($temp);
       return view('CompanyAdmin.employee_progress', compact('temp'));
   }
}
