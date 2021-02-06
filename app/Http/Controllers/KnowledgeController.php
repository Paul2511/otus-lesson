<?php

namespace App\Http\Controllers;

use App\Models\{Knowledge, User};
use Illuminate\Http\Request;
use App\Service\KnowledgeService;

class KnowledgeController extends Controller
{
    protected $knowledgeService;

    public function __construct(KnowledgeService $knowledgeService)
    {
        $this->knowledgeService = $knowledgeService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::check()){
            $this->authorize(User::VIEW_ANY, Knowledge::class);
            $knowledges = $this->knowledgeService->getKnowledges();
            return view("knowledges.index", ['knowls' => $knowledges]);
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
            $this->authorize(User::CREATE, Knowledge::class);
            return view("knowledges.create");
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
            $this->authorize(User::CREATE, Knowledge::class);
            $this->validate($request, [
                'user_id' => 'required',
                'name' => 'required',
                'description' => 'required',
                "data" => 'required'
            ]);

            $data = $request->only(['name', 'description', 'data']);
            $data["user_id"] = \Auth::id();
            $this->knowledgeService->createKnowledge($data);
             return redirect()->back();
        } else {
            return redirect()->route('user.login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Knowledge  $knowledge
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(\Auth::check()){
            $knowl = $this->knowledgeService->getKnowledge($id);
            $this->authorize(User::VIEW, $knowl);
            return view("knowledges.show", ["knowl" => $knowl]);
        } else {
            return redirect()->route('user.login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Knowledge  $knowledge
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(\Auth::check()){
            $knowl = $this->knowledgeService->getKnowledge($id);
            $this->authorize(User::UPDATE, $knowl);
            return view("knowledges.edit", ["knowl" => $knowl]);
        } else {
            return redirect()->route('user.login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Knowledge  $knowledge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(\Auth::check()){
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
                "data" => 'required'
            ]);

            $data = $request->only(['name', 'description', 'data']);
            $updatingKnowledge = $this->knowledgeService->getKnowledge($id);
            $this->authorize(User::UPDATE, $updatingKnowledge);
            $this->knowledgeService->updateKnowledge($data, $id);
            return redirect()->back();
        } else {
            return redirect()->route('user.login');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Knowledge  $knowledge
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(\Auth::check()){
            $updatingKnowledge = $this->knowledgeService->getKnowledge($id);
            $this->authorize(User::DELETE, $updatingKnowledge);
            $this->knowledgeService->deleteKnowledge($id);
            return redirect()->back();
        } else {
            return redirect()->route('user.login');
        }
    }
}
