<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\User;
use App\Http\Requests\Admin\AdminUsersStoreRequest;
use App\Http\Requests\Admin\AdminUsersUpdateRequest;
use Illuminate\Support\Facades\View;
use App\Services\Users\UsersService;
use App\Services\Routes\Providers\Admin\AdminRoutes;

class AdminUsersController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private UsersService $usersService;
    
    public function __construct(
            UsersService $usersService
            ){
        $this->usersService = $usersService;
    }
    public function index()
    {
        $users = $this->usersService->showUserList();
        view::share([
            'users' => $users,
        ]);
        
        return view('admin.users.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Admin\Users\AdminUsers  $adminUsers
     * @return \Illuminate\Http\Response
     */
    public function show(AdminUsers $adminUsers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Users\AdminUsers  $adminUsers
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminUsers $adminUsers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Users\AdminUsers  $adminUsers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminUsers $adminUsers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Users\AdminUsers  $adminUsers
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminUsers $adminUsers)
    {
        //
    }
}
