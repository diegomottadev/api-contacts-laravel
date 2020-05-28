<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
        
    use SoftDeletes;

    protected $table = 'addreses';
    protected $fillable = [
        'id',
        'street',
        'state',
        'city',
        'postalCode',
        'contact_id'
    ];
    protected $dates = ['created_at','updated_at','deleted_at'];

    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }
}
