<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \YaroslavMolchan\Rbac\Traits\Rbac;

class User extends Model
{
    use Rbac;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'name',
                  'email',
                  'password',
                  'remember_token'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    
    /**
     * Get the menuses for this model.
     */
    public function menuses()
    {
        return $this->hasMany('App\Models\Menu','usu_mod_id','id');
    }

    /**
     * Get the roleUser for this model.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_user','user_id','role_id');
    }


    /**
     * Get created_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getCreatedAtAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }

    /**
     * Get updated_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getUpdatedAtAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }

}
