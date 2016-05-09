<?php

namespace App\Providers;

use App\Categoria;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Permissao' => 'App\Policies\PermissaoPolicy',
        'App\Categoria' => 'App\Policies\CategoriaPolicy',
        'App\Contato' => 'App\Policies\ContatoPolicy',
        'App\Subcategoria' => 'App\Policies\SubcategoriaPolicy',
        'App\User' => 'App\Policies\UserPolicy'


    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        //
    }
}
