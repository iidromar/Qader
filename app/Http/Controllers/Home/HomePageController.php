<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\course;
use App\Models\lesson;
use App\Models\User;
class HomePageController extends Controller
{
    public function index(){
        return view('HomePage.index');
    }
    public function home(){

        $data = course::inRandomOrder()->limit(3)->get();
        $names=[];
        $condition = $data;
        foreach($condition as $key => $condition){
            if(!empty($condition)){
                $names[]=array(

                    'name'   =>  User::find($data[$key]['creator'])->name,
                );
            }
        }
        $data2 = course::inRandomOrder()->limit(3)->get();
        $names2=[];
        $condition = $data2;
        foreach($condition as $key => $condition){
            if(!empty($condition)){
                $names2[]=array(

                    'name'   =>  User::find($data2[$key]['creator'])->name,
                );
            }
        }
        return view('HomePage.home' , compact('data') ,['names' => $names],['names2' => $names2]);
    }
    public function courses(){
        $data = course::inRandomOrder()->limit(9)->get();
        $names=[];
        $condition = $data;
        foreach($condition as $key => $condition){
            if(!empty($condition)){
                $names[]=array(

                    'name'   =>  User::find($data[$key]['creator'])->name,
                );
            }
        }

        return view('HomePage.courses' , compact('data') ,['names' => $names]);
    }
    public function InstitCompany(){
        $data=User::where('role' , 2)->inRandomOrder()->limit(3)->get();
        $data2=User::where('role' , 2)->inRandomOrder()->limit(9)->get();
        return view('HomePage.institCompany' , compact('data' , 'data2'));
    }
    public function company(){
        $data=User::where('role' , 1)->inRandomOrder()->limit(3)->get();
        $data2=User::where('role' , 1)->inRandomOrder()->limit(9)->get();
        return view('HomePage.company' , compact('data' , 'data2'));
    }

}
