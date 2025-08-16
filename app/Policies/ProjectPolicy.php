<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class ProjectPolicy
{

    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Project $project): bool
    {
          return
             $user->role->name === 'super admin' 
            || $user->role->name === 'admin' 
            || $project->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Project $project): bool
    {
          return $user->role->name === 'SuperAdmin' 
            || $user->role->name === 'Admin' 
            || $project->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Project $project): bool
    {
         return $user->role->name === 'SuperAdmin' 
            || $user->role->name === 'Admin' 
            || $project->user_id === $user->id;
    }

 

}
