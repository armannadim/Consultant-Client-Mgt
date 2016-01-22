<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Base implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait;

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
    protected $dates = ['deleted_at'];
    protected $rules = array(
        'username' => 'required|min:6',
        'password' => 'required|min:6',
        'password_confirmation' => 'confirmed',
        'name' => 'required|alpha',
        'full_name' => 'alpha',
        'identity' => 'required|alphanumeric',
        'contact_number' => 'numeric',
        'email' => 'email',
        'role' => 'required'
    );

    public function Visit() {
        return $this->hasMany('Visits');
    }
    
    public function DocType() {
        return $this->belongsTo('DocType', 'doc_type', 'id');
    }   
    
    public function Role() {
        return $this->belongsTo('Role', 'role', 'id');
    }  
    
    public function Sender() {
        return $this->hasMany('Mail', 'sender');
    }
    
    public function Receiver() {
        return $this->hasMany('Mail', 'receiver');
    }

}
