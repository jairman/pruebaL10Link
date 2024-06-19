<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\TasksResource;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends BaseController
{

    public function index()
    {

        $tasks = Task::all();
     return $this->sendResponse(TasksResource::collection($tasks), 'Task retrieved successfully.' );

    }

    public function show($id)
    {
        $task = Task::find($id);
        if (is_null($task)) {
            return $this->sendError('Task not found.');
        }
        return $this->sendResponse(new TasksResource($task), 'Task retrieved successfully.');

    }


    public function store(StoreTaskRequest $request)
    {
       $task = Task::create($request->validated());
         return $this->sendResponse(new TasksResource($task), 'Task created successfully.');
    }


    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return $this->sendResponse(new TasksResource($task), 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return $this->sendResponse([], 'Task deleted successfully.');
    }


    public function filter(Request $request)
    {
        $query = Task::query();

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->has('due_date')) {
            $query->whereDate('due_date', $request->input('due_date'));
        }

        $tasks = $query->get();

        return response()->json($tasks);
       // return $this->sendResponse(TasksResource::collection($tasks));
    }
}
