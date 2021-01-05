<?php

namespace App\Http\Controllers;

use App\Models\{Client, User};
use Illuminate\Http\Request;
use App\Service\ClientService;

class ClientController extends Controller
{   
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::check()){
            $this->authorize(User::VIEW_ANY, Client::class);
            $clients = $this->clientService->getClients();
            return view("clients.index", ["clients" => $clients]);
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
        if(\Auth::check()){
            $this->authorize(User::CREATE, Client::class);
            return view("clients.create");
        } else {
            return redirect()->route('user.login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::check()){
            $this->authorize(User::CREATE, Client::class);
            $data = $request->only(["name", "last_name", "patronymic", "interest_status", "email", "addres", "phone", "wishes", "complaints", "selected_service", "user_id"]);
            $this->clientService->createClient($data);
            return redirect()->back(); 
        } else {
            return redirect()->route('user.login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(\Auth::check()){
            $client = $this->clientService->getClient($id);
            $this->authorize(User::VIEW, $client);
            return view("clients.show", ["client" => $client]);
        } else {
            return redirect()->route('user.login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(\Auth::check()){
            $client = $this->clientService->getClient($id); 
            $this->authorize(User::UPDATE, $client);
            return view("clients.edit", ['client' => $client]);
        } else {
            return redirect()->route('user.login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(\Auth::check()){
            $data = $request->only(["name", "last_name", "patronymic", "interest_status", "email", "addres", "phone", "wishes", "complaints", "selected_service", "user_id"]);
            $updatingClient = $this->clientService->getClient($id);
            $this->authorize(User::UPDATE, $updatingClient);
            $this->clientService->updateClient($data, $id);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::check()){
            $updatingClient = $this->clientService->getClient($id);
            $this->authorize(User::DELETE, $updatingKnowledge);
            $this->clientService->deleteClient($id);
            return redirect()->back();
        } else {
            return redirect()->route('user.login');
        }
    }
}
