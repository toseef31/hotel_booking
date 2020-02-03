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

      public function user_dashboard(Request $request)
      {
          if (!$request->session()->has('hbUser')) {
            return redirect('/');
          }
        $user_id = $request->session()->get('hbUser')->user_id;
        $user_info = DB::table('hb_users')->where('user_id',$user_id)->first();
        // dd($user_info);
        return view('frontend.dashboard',compact('user_info'));

      }

      public function update_user(Request $request)
      {
        $user_id = $request->session()->get('hbUser')->user_id;
        // dd($request->all());
        $input['name'] = $request->input('name');
        $input['email'] = $request->input('email');
        $input['phone'] = $request->input('phone');
        $input['address'] = $request->input('address');
        $input['post_code'] = $request->input('post_code');
        $input['city'] = $request->input('city');
        $input['state'] = $request->input('state');
        $input['country'] = $request->input('country');
        $input['detail'] = $request->input('detail');

        $user = DB::table('hb_users')->where('user_id',$user_id)->update($input);
        return $user;
      }

      public function check_email(Request $request)
      {
        // dd($request->all());
        $email= $request->input('email');
        $first_name= $request->input('first_name');
        $last_name= $request->input('last_name');
        $phone= $request->input('phone');
        $check_user = DB::table('hb_users')->where('email',$email)->where('type','user')->count();
        // dd($check_user);
        if ($check_user >0) {
          return $check_user;
        }else {
          $input['name'] = $first_name." ".$last_name;
          $input['phone'] = $phone;
          $input['email'] = $email;
          $input['type'] = "guest";
          $user = DB::table('hb_users')->insertGetId($input);
          $request->session()->put('user_id',$user);
          return "new";
        }
      }
      public function update_detail(Request $request)
      {
        // dd($request->all());
        $user_id='';
        if ($request->session()->has('hbUser')) {
          $user_id = $request->session()->get('hbUser')->user_id;
        }
        if ($user_id == "") {
          $user_id = $request->session()->get('user_id');
        }
        // dd($user_id);
        $input['city'] = $request->input('city');
        $input['country'] = $request->input('country');
        $input['address'] = $request->input('address');
        $input['state'] = $request->input('state');
        $input['post_code'] = $request->input('post_code');
        $input['detail'] = $request->input('detail');
        $user = DB::table('hb_users')->where('user_id',$user_id)->update($input);
        return $user;
      }

      public function logout(Request $request)
      {
        $request->session()->flush();
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
