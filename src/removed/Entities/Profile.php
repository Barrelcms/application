<?php namespace Barrel\Entities;

use Barrel\Database\Model;

class Profile extends Model {

    protected static $rules = [
        'user_id' => 'required|unique:profiles,user_id,:id',
        'first_name' => 'min:2',
        'last_name' => 'min:2'
    ];

    /**
     * Profiles belong to a single user.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

}