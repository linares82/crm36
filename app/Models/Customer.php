<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

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
        'razon',
        'nombre1',
        'nombre2',
        'ape_paterno',
        'ape_materno',
        'calle',
        'numero_int',
        'numero_ext',
        'colonia',
        'ciudad',
        'estado_id',
        'municipio_id',
        'cp',
        'celular',
        'celular_confirmar',
        'cuenta_sms',
        'fijo',
        'email',
        'cuenta_email',
        'email_confirmar',
        'usu_alta_id',
        'usu_mod_id'
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
     * Get the estado for this model.
     */
    public function estado()
    {
        return $this->belongsTo('App\Models\Estado', 'estado_id', 'id');
    }

    /**
     * Get the municipio for this model.
     */
    public function municipio()
    {
        return $this->belongsTo('App\Models\Municipio', 'municipio_id', 'id');
    }

    /**
     * Get the user for this model.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'usu_mod_id', 'id');
    }

    public function oportunity()
    {
        return $this->belongsToMany('App\Models\Oportunity', 'customer_oportunity', 'customer_id', 'oportunity_id');
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

    /**
     * Get deleted_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getDeletedAtAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }
}
