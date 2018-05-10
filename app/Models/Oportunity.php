<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Oportunity extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'oportunities';

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
                  'oportunity_label_id',
                  'descripcion',
                  'oportunity_st_id',
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
     * Get the oportunityLabel for this model.
     */
    public function oportunityLabel()
    {
        return $this->belongsTo('App\Models\OportunityLabel','oportunity_label_id','id');
    }

    /**
     * Get the oportunitySt for this model.
     */
    public function oportunitySt()
    {
        return $this->belongsTo('App\Models\OportunitySt','oportunity_st_id','id');
    }

    /**
     * Get the user for this model.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User','usu_mod_id','id');
    }
    
    public function usu_mod()
    {
        return $this->belongsTo('App\Models\User','usu_mod_id','id');
    }
    
    public function usu_alta()
    {
        return $this->belongsTo('App\Models\User','usu_alta_id','id');
    }

    /**
     * Get the customer for this model.
     */
    public function customer()
    {
        return $this->belongsToMany('App\Models\Customer', 'customer_oportunity', 'oportunity_id', 'customer_id');
    }
    
    public function product()
    {
        return $this->belongsToMany('App\Models\Product', 'oportunity_product', 'oportunity_id', 'product_id');
    }
    
    public function archivos()
    {
        return $this->hasMany('App\Models\FilesCustomer');
    }
    
    public function alert()
    {
        return $this->hasMany('App\Models\Alert');
    }
    
    public function note()
    {
        return $this->hasMany('App\Models\Note');
    }
    
    public function relatedTask()
    {
        return $this->hasMany('App\Models\RelatedTask');
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
