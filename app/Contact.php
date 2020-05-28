<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    //
    use SoftDeletes;

    protected $table = 'contacts';
    protected $fillable = [
        'id',
        'name',
        'surname',
        'nameComplete',
        'dateOfBirth',
        'age',
        'email',
        'celphone',
        'work',
        'siteWeb',
        
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function addresses()
    {
        return $this->hasMany('App\Address');
    }

    public function telephones()
    {
        return $this->hasMany('App\Telephone');
    }

    public function emails()
    {
        return $this->hasMany('App\EmailAddress');
    }

    public function work()
    {
        return $this->hasOne('App\Work');
    }
}
