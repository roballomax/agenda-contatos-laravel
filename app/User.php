<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_id', 'adm'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function get_all_users_from_logged(){
        return User::where('user_id', Auth::user()->id)
            ->orderBy('name', 'asc')
            ->get();
    }

    public function permissoes_user(){
        return $this->hasMany(Permissoes_user::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    protected static function verifica_filiacao($user_id){

        $users = [Auth::user()->id, Auth::user()->user_id];
        foreach(Auth::user()->users as $user){
            $users[] = $user->id;
        }

        return User::whereIn('user_id', $users)
            ->where('id', $user_id)
            ->limit(1)
            ->get();
    }

}
