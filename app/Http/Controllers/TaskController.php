<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRegisterRequest;
use App\Models\Project;
use App\Models\Task;
use App\Trait\TraitsApiResponseTrait;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    use ApiResponseTrait,AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
          $this->authorize('viewAny', Task::class);

         $tasks = Task::all();


        if ($tasks) {
            return $this->success('All Tasks', $tasks);
        }

        return $this->error('No tasks found', 404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRegisterRequest $request)
    {

          $this->authorize('create', Task::class);

         $data = $request->validated();

        // Ensure project exists before creating the task
        $project = Project::find($data['project_id']);
        if (!$project) {
            return $this->error('Project not found', 404);
        }

        $task = Task::create([
            'project_id' => $data['project_id'],
            'status' => $data['status'] ,
            'due_date' => $data['due_date'],
            'title' => $data['title']
        ]);

        return $this->success('Task created successfully', $task);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRegisterRequest $request, string $id)
    {
          $task = Task::find($id);

  

        if (!$task) {
            return $this->error('Task not found', 404);
        }

           $this->authorize('update', $task);

        $updated = $task->update($request->validated());

        if ($updated) {
            return $this->success('Task updated successfully', $task);
            
        } else {
            return $this->error('Failed to update task', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $task = Task::find($id);

        if (!$task) {
            return $this->error('Task not found', 404);
        }
         $this->authorize('delete', $task);

        if ($task->delete()) {
            return $this->success('Task deleted successfully');
        }

        return $this->error('Failed to delete task', 500);
    }
}
