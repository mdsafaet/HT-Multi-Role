<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRegisterRequest;
use App\Models\Project;
use App\Trait\TraitsApiResponseTrait;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

     use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $project = Project::all();

      

         if ($project) {
            return $this->success('All Project', $project);
        }

        return $this->error();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRegisterRequest $request)
    {
        $data = $request->validated();

      

        $project = Project::create([
            'name' => $data['name'],
            'user_id' => $data['user_id']
        ]);
            
    

        


        return $this->success($project);
        
    
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
    public function update(ProjectRegisterRequest $request, string $id)
    {
        $project = Project::find($id);

        

                if (!$project) {
                    return $this->error('Project not found', 404);
                }

                $updated = $project->update($request->validated());

                if ($updated) {
                    return $this->success($project);
                } else {
                    return $this->error('Failed to update project', 500);
                }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $project = Project::find($id);

        if (!$project) {
            return $this->error('Project not found', 404);
        }
    

        if ($project->delete()) {
            return $this->success('Project deleted successfully');
        }

    

        return $this->error('Failed to delete project', 500);
    }
}
