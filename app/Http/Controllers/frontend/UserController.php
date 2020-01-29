<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use DB;
use Carbon;
use Session;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


      public function accountRegister(Request $request){

        // dd($request->all());
        if($request->isMethod('post')){
          // dd($request->all());
          $this->validate($request,[
            'email' => 'required|email|unique:hb_users,email',
            'phone' => 'required|digits_between:10,12',
            'name' => 'required|min:1|max:50',
            'password' => 'required|min:5|max:50'

          ],[

            'email.unique' => 'Email must be unique',
            'email.required' => 'Enter Email',
            'password.required' => 'Enter password',
            'phone.required' => 'Enter Phone Number',
            'phone.digits_between' => 'Phone Number must be contain 10,12 digits',
          ]);
          $input['name'] = $request->input('name');
          $input['email'] = trim($request->input('email'));
          $input['phone'] = trim($request->input('phone'));
          $input['password'] = md5(trim($request->input('password')));

          // dd($input);
          $userId = DB::table('hb_users')->insertGetId($input);
          return $userId;
        }
      }

      public function accountLogin(Request $request){
        // dd($request->all());
        // $next = $request->input('next');
        if($request->ajax()){
          $email = $request->input('email');
          $password = md5(trim($request->input('password')));
          $user = DB::table('hb_users')->where('email','=',$email)->where('password','=',$password)->first();
          // dd($user);
          if ($user =="") {
            return "invalid";
          }else{
            $request->session()->put('hbUser', $user);
            setcookie('cc_data', $user->user_id, time() + (86400 * 30), "/");
            return 1;
          }
        }
      }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Session::flush();
       return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
