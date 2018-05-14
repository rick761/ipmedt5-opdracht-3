<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Product extends Model
{
    //
    protected $table = 'producten';
    public $incrementing = false;

    protected $fillable = [
        'share_status','share_id'
    ];

    public function Owner()
    {
        return $this->belongsTo('App\User','user_id', 'id');
    }

    public function Shared_too(){
        return $this->hasOne('App\User', 'id', 'share_id');
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = (string) Uuid::generate(4);
        });
    }
}
