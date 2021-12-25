<?php

namespace App\Policies;

use App\Models\Donhang;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DonhangPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    

    public function view(User $user, Donhang $donhang)
    {
        return ($donhang->id_nhanvienquanly === $user->id) or ($donhang->id_nhanvienkhoitao === $user->id);
    }

    


    public function create(User $user)
    {
        return ($user->id_loainhanvien <> 1);
    }

    

    public function update(User $user, Donhang $donhang)
    {
        return ($donhang->id_nhanvienquanly === $user->id);
    }

    

    public function delete(User $user, Donhang $donhang)
    {
        return ($donhang->id_nhanvienkhoitao === $user->id) and ($donhang->id_nhanvienquanly === $user->id) and ($donhang->id_trangthai === 2);
    }

    

    public function restore(User $user, Donhang $donhang)
    {
        //
    }

    
    
    public function forceDelete(User $user, Donhang $donhang)
    {
        //
    }
}
