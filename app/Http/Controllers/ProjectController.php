<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRegisterRequest;
use App\Models\Project;
use App\Trait\TraitsApiResponseTrait;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class ProjectController extends Controller
{

     use ApiResponseTrait , AuthorizesRequests ;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

         $this->authorize('viewAny', Project::class);
         
        $project = Project::all();

      

         if ($project) {
            return $this->success('All Project', $project);
        }





        return $this->error();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRegisterRequest $request  )
    {

      $this->authorize('create', Project::class);
     
        $data = $request->validated();

        // dd($request->all());

        $project = Project::create( $data );


          $this->authorize('view', $project);
        // ([
        //     'name' => $data['name'],
        //     'user_id' => $data['user_id']

        // ]);

      
         $project->tags()->attach($request->tags);
           
          
    

        return $this->success($project->load('tags'));
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
                 $this->authorize('update', $project);

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

        $this->authorize('delete', $project);
    

        if ($project->delete()) {
            return $this->success('Project deleted successfully');
        }

    

        return $this->error('Failed to delete project', 500);
    }
}
