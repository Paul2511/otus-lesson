<?php

namespace App\Http\Controllers;

use App\Models\Client;
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
            $authUser = \Auth::user();
            if($authUser->can("viewAny", Client::class)){
                $clients = $this->clientService->getClients();
                return view("clients.index", ["clients" => $clients]);
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
        if(\Auth::check()){
            $authUser = \Auth::user();
            if($authUser->can("create", Client::class)){
                return view("clients.create");
            } else {
                return "Can't";
            }
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
            $authUser = \Auth::user();
            if($authUser->can("create", Client::class)){
                $data = $request->only(["name", "last_name", "patronymic", "interest_status", "email", "addres", "phone", "wishes", "complaints", "selected_service", "user_id"]);
                $this->clientService->createClient($data);
                return redirect()->back(); 
            } else {
                return "Can't";
            }
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
            $authUser = \Auth::user();
            $client = $this->clientService->getClient($id);
            if($authUser->can("view", $client)){
                return view("clients.show", ["client" => $client]);
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
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(\Auth::check()){
            $authUser = \Auth::user();
            $client = $this->clientService->getClient($id); 
            if($authUser->can("update", $client)){
                return view("clients.edit", ['client' => $client]);
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
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(\Auth::check()){
            $data = $request->only(["name", "last_name", "patronymic", "interest_status", "email", "addres", "phone", "wishes", "complaints", "selected_service", "user_id"]);
            $authUser = \Auth::user();
            $updatingClient = $this->clientService->getClient($id);
            if($authUser->can("update", $updatingClient)){
                $this->clientService->updateClient($data, $id);
                return redirect()->back();
            } else {
                return "Can't";
            }
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
            $authUser = \Auth::user();
            $updatingClient = $this->clientService->getClient($id);
            if($authUser->can("delete", $updatingKnowledge)){
                $this->clientService->deleteClient($id);
                return redirect()->back();
            } else {
                return "Can't";
            }
        } else {
            return redirect()->route('user.login');
        }
    }
}
