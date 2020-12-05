<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Service\UserService;

class UserController extends Controller
{
	protected $userService;

	public function __construct(UserService $userService)
	{
        $this->userService = $userService;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$users =$this->userService->giveMeAllUser();
        return view("users", ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	if(!Auth::check()){
    		return view("registration");
    	}
    	return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           	'name' => 'required|max:255',
           	'password' => 'required',
           	'last_name' => 'required|max:255',
           	'patronymic' => 'required',
           	'role' => 'required',
           	'email' =>'required|unique:users'
       	]);

        $request->password = Hash::make($request->password);
        if($request->role != "manager" && $request->role != "developer"){
        	throw Exception("invalid role");
    	}
       	// create record and pass in only fields that are fillable
        $this->userService->createUser($request);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$user = $this->userService->giveMeUser($id);
        return view("lk", ["user" => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$user = $this->userService->giveMeUser($id);
        return view("user_edit", ["user" => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$this->validate($request, [
           	'name' => 'required|max:255',
           	'last_name' => 'required|max:255',
           	'patronymic' => 'required',
           	'role' => 'required',
           	'email' =>'required|unique:users,id,'.$id
       	]);
        $this->userService->updateUser($request, $id);
       	return redirect()->route('user.show', ['user' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$this->userService->deleteUser($id);
        return redirect()->back();
    }

    public function authenticate(Request $request){
    	$credentials = $request->only("email","password");
    	if(Auth::attempt($credentials)){
    		return redirect()->route('user.show', ['user' => Auth::id()]);
    	}
    }
    public function login(){
    	if(!Auth::check()){
    		return view("login");
    	}
    	return redirect()->back();
    }
}
