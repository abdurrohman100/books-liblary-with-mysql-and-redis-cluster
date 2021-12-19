<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Support\Facades\Hash;



class AuthenticationController extends Controller
{
    //
    public function showLogin()
    {
        return view('authentication.login');
    }

        //
    public function Login(Request $request)
    {
        $user = User::where('email' ,'=', $request->input('email'))->first();

        if ($user) {
            if (Hash::check($request->input('password'), $user->password)) {


                $request->session()->put([
                    'login' => true,
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'isAdmin' => $user->isAdmin ,
                ]);
                Session::flash('success', 'Anda berhasil Login');
                return redirect('/home');
            }else{
                Session::flash('error', 'Password tidak cocok');
                return redirect()->route('auth.showLogin');
            }
            
        }else{
            Session::flash('error', 'Akun tidak ditemukan');
            return redirect()->route('auth.showLogin');
        }
        return view('authentication.register');
        }

    public function showRegister()
    {
        return view('authentication.register');
    }

    public function Register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email'         => 'required|email|unique:users',
            'password'      => 'required|min:8',
            'password_confirmation'=>'required|min:8|same:password',
            'name'          => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->all());
            return redirect()->back()->withInput();
        }


        try {
          
            User::create([
                'email'         => $request->input('email'),
                'password'      => Hash::make($request->input('password')),
                'name'          => $request->input('name'),
                'isAdmin'       => false
            ]);


            Session::flash('success', 'Akun berhasil didaftarkan');
            return view('authentication.login');
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            $errorMsg = $e->errorInfo[2];
            Session::flash('error', $errorMsg);
            return view('authentication.login');
        }
    }
}
