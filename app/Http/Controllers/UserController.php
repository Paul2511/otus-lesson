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
    	$users =$this->userService->getUsers();
        return view("users.index", ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	if(!Auth::check()){
    		return view("users.create");
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
        $data = $request->only([
            'name',
            'last_name',
            'patronymic',
            'email',
            'password',
            'role',
            'skills'
        ]);
        $this->userService->createUser($data);
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
    	$user = $this->userService->getUser($id);
        return view("mysqlnd_qc_set_user_handlers(get_hash, find_query_in_cache, return_to_cache, add_query_to_cache_if_not_exists, query_is_select, update_query_run_time_stats, get_stats, clear_cache).show", ["user" => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$user = $this->userService->getUser($id);
        return view("users.edit", ["user" => $user]);
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
        $data = $request->only([
            'name',
            'last_name',
            'patronymic',
            'email',
            'password',
            'role',
            'skills'
        ]);
        $this->userService->updateUser($data, $id);
       	return redirect()->route('users.show', ['user' => $id]);
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
    		return redirect()->route('users.show', ['user' => Auth::id()]);
    	}
    }
    public function login(){
    	if(!Auth::check()){
    		return view("users.login");
    	}
    	return redirect()->back();
    }
}
