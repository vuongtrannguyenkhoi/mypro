<?php namespace Qdesign\Models;

use Illuminate\Support\Facades\Auth;

abstract class AbstractModel extends \Eloquent{


    protected $guarded = array('id');

    public static function boot(){
        parent::boot();

        static::creating(function( $model ){
            $model->created_by = Auth::check() ? Auth::user()->id : 0;
        });

        static::updating(function( $model ){
            $model->updated_by = Auth::check() ? Auth::user()->id : 0;
        });
    }

    public function myUpdate(array $updatedFields,array $input){
        foreach($updatedFields as $field){
            if(isset($input[$field])) $this->$field = $input[$field];
        }
        return true;
    }

    public function author()
    {
        return $this->belongsTo('\Qdesign\Models\User','created_by');
    }
}