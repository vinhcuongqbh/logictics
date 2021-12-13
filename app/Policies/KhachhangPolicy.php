<?php

namespace App\Policies;

use App\Models\Khachhang;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KhachhangPolicy
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
        return true;
    }

    

    public function view(User $user, Khachhang $khachhang)
    {
        return ($khachhang->id_nhanvienquanly === $user->id);
    }

   

    public function create(User $user)
    {
        return true;
    }

    
    
    public function update(User $user, Khachhang $khachhang)
    {
        return ($khachhang->id_nhanvienquanly === $user->id);
    }

    

    // public function delete(User $user, Khachhang $khachhang)
    // {
    //     //
    // }

    

    // public function restore(User $user, Khachhang $khachhang)
    // {
    //     //
    // }

    
    
    // public function forceDelete(User $user, Khachhang $khachhang)
    // {
    //     //
    // }
}
