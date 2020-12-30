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
        if(\Auth::check()){
            $authUser = \Auth::user();
            if($authUser->can("viewAny", User::class)){
                $users =$this->userService->getUsers();
                return view("users.index", ['users' => $users]);
            } else {
                return "Can't";
            }
        } else {
            return redirect()->route('user.login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authUser = \Auth::user();
        $role = '';
        if($authUser != null){
            $role = $authUser->role;
        }
    	if(!\Auth::check() || $role == 'admin'){
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
        $newUser = $this->userService->createUser($data);
        if(!\Auth::check()){
            \Auth::loginUsingId($newUser->id);
        }
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
        if(\Auth::check()){
            $authUser = \Auth::user();
            $user = $this->userService->getUser($id);
            if($authUser->can("view", $user)){
                return view("users.show", ["user" => $user]);
            } else {
                return "Can't";
            }
        } else {
            return redirect()->route('user.login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        if(\Auth::check()){
            $authUser = \Auth::user();
            $user = $this->userService->getUser($id);
            if($authUser->can("update", $user)){
                return view("users.edit", ["user" => $user]);
            } else {
                return "Can't";
            }
        } else {
            return redirect()->route('user.login');
        }
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
        if(\Auth::check()){
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
            $authUser = \Auth::user();
            $updatingUser = $this->userService->getUser($id);
            if($authUser->can("update", $updatingUser)){
                $this->userService->updateUser($data, $id);
           	    return redirect()->route('users.show', ['user' => $id]);
            } else {
                return "Can't";
            }
        } else {
            return redirect()->route('user.login');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::check()){
            $authUser = \Auth::user();
            $updatingUser = $this->userService->getUser($id);
            if($authUser->can("delete", $updatingUser)){
                $this->userService->deleteUser($id);
                return redirect()->back();
            } else {
                return "Can't";
            }
        } else {
            return redirect()->route('user.login');
        }
    }

    public function authenticate(Request $request)
    {
    	$credentials = $request->only("email","password");
        $credentials["password"] = \Hash::make($credentials["password"]);
    	if(\Auth::attempt($credentials)){
    		return redirect()->route('users.show', ['user' => Auth::id()]);
    	}
    }

    public function login()
    {
    	if(!\Auth::check()){
    		return view("users.login");
    	}
    	return redirect()->back();
    }

    public function logout()
    {
        \Auth::logout();
    }
}
