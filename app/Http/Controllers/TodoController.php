<?php

namespace App\Http\Controllers;

use App\Models\{Todo, User};
use Illuminate\Http\Request;
use App\Service\TodoService;

class TodoController extends Controller
{
    protected $todoService;

	public function __construct(TodoService $todoService)
	{
		$this->todoService = $todoService;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function index()
    {
        //
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create()
    {
        //
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$this->validate($request, [
    		'task_id' => 'required',
           	'name' => 'required'
       	]);
        $data = $request->only(["name", "status", "task_id"]);
    	$this->todoService->createTodo($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    /*
    public function show(Todo $todo)
    {
        //
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    /*public function edit(Todo $todo)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    	if($request->query_type == "to_done"){
        	$this->todoService->updateTodos(["status" => 1], $request->todo_done);
    	} else if($request->query_type == "to_work"){
    		$this->todoService->updateTodos(["status" => 0], $request->todo_to_work);
    	}
    	return redirect()->back();   	
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->todoService->deleteTodo($id);
        return redirect()->back();
    }
}
