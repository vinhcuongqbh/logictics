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

        //Bộ lọc sidebar của AdminLTE 3
        Gate::define('khohang', function (User $user) {
            return $user->id_loainhanvien === 1;
        });
        Gate::define('nhanvien', function (User $user) {
            return $user->id_loainhanvien === 1;
        });
        Gate::define('khachhang', function (User $user) {
            return $user->id_loainhanvien === 1;
        });
        Gate::define('caidat', function (User $user) {
            return $user->id_loainhanvien === 1;
        });
        Gate::define('danhmuc', function (User $user) {
            return $user->id_loainhanvien === 1;
        });

        //
    }
}
