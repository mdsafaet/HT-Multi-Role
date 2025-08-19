<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRegisterRequest;
use App\Models\Tag;
use App\Trait\TraitsApiResponseTrait;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class TagController extends Controller
{

    use ApiResponseTrait,AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRegisterRequest $request)
    {

        $this->authorize("create", Tag::class);
         $data = $request->validated();

       

        $tag = Tag::create([
            'name' => $data['name']
        ]);

        return $this->success('Tag created successfully', $tag);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::find($id);

        

        if (!$tag) {
            return $this->error('Tag not found', 404);
        }

        $this->authorize('update', $tag);

        if ($tag->delete()) {
            return $this->success('Tag deleted successfully');
        }

        return $this->error('Failed to delete tag', 500);
    }
    
}
