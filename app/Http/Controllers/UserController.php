<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $users = User::with('role')->get();
        return view('user.users', ['users' =>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Hacer validaciones
        
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'username' => ['required', 'unique','string', 'min:5'],
                'role' => ['required', 'not_in:0']
            ]);
        return $this->createUser($request->all());
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        return view('user.edit', ['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'username' => ['required', 'unique','string', 'min:5'],
                'role' => ['required', 'not_in:0']
            ]);
        
        try {
            $user->name = $request->name;
            $user->username = $request->username;
            $user->role_id = $request->role;
            if($request->password != null){
                $user->password =  Hash::make($request->password);
            }
    
            $user->save();
            Session::put('success', 'El usuario se actualizó con exito.');
        } catch (\Exception $e) {
            Session::put('error', $e->getMessage());
        }
     
      

        return $this->edit($user);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->delete()){
            Session::put('success', 'El usuario se borro con exito.');
            
        }else{
            Session::put('error', 'El usuario no pude ser eliminado, porfavor vuelve a intentarlo.');
        }
        return redirect('users');
        
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function createUser(array $data)
    {
        try {
            User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
                'role' => $data['role'],
            ]);
            Session::put('success', 'El usuario se creó con exito.');
        } catch (\Exception $e) {
            Session::put('error', $e->getMessage());
        }
      
       
        return view('user.create')->with('success', 'El usuario se creó con exito.');
    }
}
