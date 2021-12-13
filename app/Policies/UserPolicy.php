<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;    

    public function before(User $user, $ability)
    {
        if ($user->id_loainhanvien === 1) {
            return true;
        }
    }

    
    public function viewAny(User $user)
    {
        return false;
    }

    
    
    public function view(User $user, $nhanvien)
    {
        return $user->id === $nhanvien->id;

    }

   

    public function create(User $user)
    {
        return false;
    }

    

    public function update(User $user)
    {
        return false;
    }

    

    public function destroy(User $user)
    {
        return false;
    }



    public function restore(User $user)
    {
        return false;
    }



    public function resetpass(User $user, $nhanvien)
    {
        return $user->id === $nhanvien->id;
    }




    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
