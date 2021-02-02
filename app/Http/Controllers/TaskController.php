<?php

namespace App\Http\Controllers;

use App\Models\{Task, User};
use Illuminate\Http\Request;
use App\Service\TaskService;

class TaskController extends Controller
{
   protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::check()){
            $this->authorize(User::VIEW_ANY, Task::class);
            $tasks = $this->taskService->getTasks();
            return view("tasks.index", ["tasks" => $tasks]);
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
            return view("tasks.create");
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
            $this->validate($request, [
                'user_id' => 'required',
                'name' => 'required|max:255',
            ]);

            // create record and pass in only fields that are fillable
            $data = $request->only(["name", "description", "status"]);
            $data["user_id"] = \Auth::id();
            $this->taskService->createTask($data);
            return redirect()->back();
        } else{
            return redirect()->route('user.login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(\Auth::check()){
            $task = $this->taskService->getTask($id);
            $this->authorize(User::VIEW, $task);
            return view("tasks.show", ["task" => $task]);
        } else {
            return redirect()->route('user.login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(\Auth::check()){
            $authUser = \Auth::user();
            $task = $this->taskService->getTask($id);
            if($authUser->can(User::UPDATE, $task)){
                return view("tasks.edit", ["task" => $task]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(\Auth::check()){
            $this->validate($request, [
                'name' => 'required|max:255',
            ]);

            $data = $request->only(["name", "description", "status"]);
            $updatingTask = $this->taskService->getTask($id);
            $this->authorize(User::UPDATE, $updatingTask);
            $this->taskService->updateTask($data, $id);
            return redirect()->back();
        } else {
            return redirect()->route('user.login');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(\Auth::check()){
            $updatingTask = $this->taskService->getTask($id);
            $this->authorize(User::DELETE, $updatingTask);
            $this->taskService->deleteTask($id);
            return redirect()->back();
        } else {
            return redirect()->route('user.login');
        }
    }
}
