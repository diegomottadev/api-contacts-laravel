<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    //
    use SoftDeletes;

    protected $table = 'works';

    protected $fillable = [
        'id',
        'position',
        'company',
        'contact_id', 
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }
}
