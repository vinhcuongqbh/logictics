<?php

namespace App\Providers;
use App\Models\User;
use App\Models\Khohang;
use App\Policies\KhohangPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Khohang::class => KhohangPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Menu sidebar của AdminLTE 3
        Gate::define('khohang', function (User $user) {
            return $user->id_loainhanvien === 1;
        });       
        Gate::define('nhanvien', function (User $user) {
            return $user->id_loainhanvien === 1;
        });
        Gate::define('khachhang', function (User $user) {
            return $user->id_loainhanvien === 1;
        });
        Gate::define('dongia', function (User $user) {
            return $user->id_loainhanvien == 1;
        });
        Gate::define('donhang', function (User $user) {
            return $user->id_loainhanvien !== 1;
        });
        Gate::define('chuyenhang', function (User $user) {
            return $user->id_loainhanvien !== 1;
        });
        Gate::define('chuyenhangchonhapkho', function (User $user) {
            return $user->id_loainhanvien == 2;
        });
        Gate::define('thongke-donhang', function (User $user) {
            return true;
        });
        Gate::define('thongke-doanhthu', function (User $user) {
            return true;
        });
        Gate::define('thongke-loinhuan', function (User $user) {
            return true;
        });
    }
}
