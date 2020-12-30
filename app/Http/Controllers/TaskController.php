<?php

namespace App\Http\Controllers;

use App\Models\Task;
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
            $authUser = \Auth::user();
            if($authUser->can("viewAny", Task::class)){
                $tasks = $this->taskService->getTasks();
                return view("tasks.index", ["tasks" => $tasks]);
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
                'name' => 'required|max:255',
            ]);

            // create record and pass in only fields that are fillable
            $data = $request->only(["name", "description", "status"]);
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
            $authUser = \Auth::user();
            $task = $this->taskService->getTask($id);
            if($authUser->can("view", $task)){
                return view("tasks.show", ["task" => $task]);
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
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(\Auth::check()){
            $authUser = \Auth::user();
            $task = $this->taskService->getTask($id);
            if($authUser->can("update", $task)){
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
            $authUser = \Auth::user();
            $updatingTask = $this->taskService->getTask($id);
            if($authUser->can("update", $updatingTask)){
                $this->taskService->updateTask($data, $id);
                return redirect()->back();
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
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::check()){
            $authUser = \Auth::user();
            $updatingTask = $this->taskService->getTask($id);
            if($authUser->can("delete", $updatingTask)){
                $this->taskService->deleteTask($id);
                return redirect()->back();
            } else {
                return "Can't";
            }
        } else {
            return redirect()->route('user.login');
        }
    }
}
