<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;

class TasksController extends Controller
{
    /**
     * @return array
     */
    public function index()
    {
        return ['tasks' => Task::all()];
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return Task::find($id);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $task = Task::create($request->get('task'));
        $taskResponse = ['tasks' => $task];
        return response()->json($taskResponse, 201);
    }

    /**
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Task $task)
    {
        $task->update($request->get('task'));
        return response()->json($task, 200);
    }

    /**
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Task $task)
    {
        $task->delete();

        return response()->json(null, 204);
    }
}
