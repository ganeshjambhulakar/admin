<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::paginate(20);
        return view('users.list', compact('data', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        return view('users.create', compact('data', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        session()->flush();
        $request->validate([
            'name' => 'required',
            'email' => 'required | unique:users',
            'password' => 'required | min:6',
            'confirmpassword' => 'required_with:password|same:password|min:6',

        ]);

        $obj = new User();
        $obj->name = $request->post('name');
        $obj->email = $request->post('email');
        $obj->password = $request->post('password');
        $data = $obj->save();
        if(session()->get("ROLE") == 'ADMIN'){
            return redirect(config("base_url") . '/users')->with("msg", "Register Successfully");
        }
        return redirect(config("base_url") . '/')->with("msg", "Register Successfully");
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
        $data = User::find($id);

        return view('users.edit', compact(['data', 'data']));
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
        $request->validate([
            'name' => 'required',
            'email' => 'required | email | unique:users,email,'.$id,
       ]);

        // print_r($data);exit;
        $obj = User::find($id);
        $obj->name = $request->post('name');
        $obj->email = $request->post('email');
        $data = $obj->update();

        return redirect(config("base_url") . '/users')->with("msg", "User Updated Successfully");
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::find($id)->delete();
        return redirect('/users')->with("msg", "User deleted Successfully");
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $email = $request->post('email');

        $admins = ['jambhulakar8530@gmail.com', 'stacklab@gmail.com'];
        //Select user data form database
        $user = User::where('email', $email)->first();

        //Check password hash
        if (!$user || !Hash::check($request->password, $user->password)) {
            //Invalid login username or password!
            
            return redirect("/")->with("msg", "Invalid username and password");
        } else {
            session()->put('ROLE', 'user');  //default role
            if (in_array($user->email, $admins)) { 
                session()->put('ROLE', 'ADMIN');      //jambhulakar8530@gmail.com and stacklab@gmail.com are put by default as Admin 
            }
            session()->put('LOGIN','YES');
            session()->put('USER',$user);
            
            return redirect("products");
        }
    }
    
    public function userdetail()
    {
        return view('users.login');
    }
    public function logout(Request $request)
    {
        session()->flush();
        return redirect("/users/login");
    }
}
