<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable,HasRoles,HasEagerLimit;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];




    // ------------------------------------------

    public function products()
    {
        return $this->hasMany(Product::class,'vendor_id','id');
    }
    // ------------------------------------------


    public function scopeNotRole(Builder $query,string $role, $guard = 'admin'): Builder
    {

        $role = Role::where('name','super_admin')->where('guard_name','admin')->first();

        if(!$role){
            return $query;
        }

        $ids_super_admin = Admin::role($role,'admin')
                                ->get()
                                ->pluck('id');

        return $query->whereNotIn('id',$ids_super_admin);

    }


    // public function scopeNotRole(Builder $query, $roles, $guard = null): Builder
    // {


    //     return


    //      if ($roles instanceof Collection) {
    //          $roles = $roles->all();
    //      }

    //      if (! is_array($roles)) {
    //          $roles = [$roles];
    //      }

    //      $roles = array_map(function ($role) use ($guard) {
    //          if ($role instanceof Role) {
    //              return $role;
    //          }

    //          $method = is_numeric($role) ? 'findById' : 'findByName';
    //          $guard = $guard ?: $this->getDefaultGuardName();

    //          return $this->getRoleClass()->{$method}($role, $guard);
    //      }, $roles);

    //      return $query->whereHas('roles', function ($query) use ($roles) {
    //          $query->where(function ($query) use ($roles) {
    //              foreach ($roles as $role) {
    //                  $query->where(config('permission.table_names.roles').'.id', '!=' , $role->id);
    //              }
    //          });
    //      });
    // }

    // ------------------------------------------
}
