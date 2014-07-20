<?php namespace Barrel\Entities;

use Barrel\Database\Model;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Model implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    public static $rules = [
        'username' => 'unique:users,username,:id|min:5',
        'email' => 'required|unique:users,email,:id|email',
        'password' => 'required|min:6'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    /**
     * A user should have one profile.
     *
     * @return mixed
     */
    public function profile()
    {
        return $this->hasOne('Profile');
    }

    /**
     * A user can be associated with many roles.
     *
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany('Role');
    }

}