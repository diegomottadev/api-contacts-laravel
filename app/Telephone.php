<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Telephone extends Model
{
    use SoftDeletes;

    protected $table = 'telephones';
    protected $fillable = [
        'id',
        'number',
        'type',
        'contact_id'
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }
}
