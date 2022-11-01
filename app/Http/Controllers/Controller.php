<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CostImport;
use Illuminate\Http\Request;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function index(){

        return view('home');

    }

    function signIn($email){

        $email = $email."@ablaviation.com";
        $user = User::Where('USER_EMAIL', 'like', $email)->first();
        if($user){
            \Auth::login($user);
            return redirect('/');
        }else{
            return back();
        }

    }

    function import(Request $request){

        try{

            $user = \Auth::user();
            Excel::import(new CostImport($user), $request->file('file'));
      
        }
        catch(Exception $e){
            echo $e;
        }

    }
}
