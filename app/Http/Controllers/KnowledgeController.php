<?php

namespace App\Http\Controllers;

use App\Models\Knowledge;
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
        $knowledges = $this->knowledgeService->giveMeAllKnowledge();
        return view("knowledges", ['knowls' => $knowledges]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("knowledge_create");
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
            'user_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            "data" => 'required'
        ]);

        $this->knowledgeService->createKnowledge($request);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Knowledge  $knowledge
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $knowl = $this->knowledgeService->giveMeKnowledge($id);
        return view("knowledge_detailed", ["knowl" => $knowl]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Knowledge  $knowledge
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $knowl = $this->KnowledgeService->giveMeKnowledge($id);
        return view("knowledge_edit", ["knowl" => $knowl]);
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
        $this->validate($request, [
            'user_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            "data" => 'required'
        ]);

        $this->knowledgeService->updateKnowledge($request, $id);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Knowledge  $knowledge
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->knowledgeService->deleteKnowledge($id);
        return redirect()->back();
    }
}
