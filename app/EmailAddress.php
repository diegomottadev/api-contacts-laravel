<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailAddress extends Model
{
    use SoftDeletes;

    protected $table = 'emails';
    protected $fillable = [
        'id',
        'email',
        'type',
        'contact_id'
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }
}
