<?php

/*
 * Initial version of this class has been created, modified and published by Aseq A Arman Nadim. 
 * For any sugestion, update, request, advice feel free to contact armannadim@msn.com
 * 
 * Developer: Aseq A Arman Nadim
 * Email: armannadim@msn.com
 * Web: www.armannadim.com
 */

/**
 * Description of Clients
 *
 * @author NAseq
 * @date 28-May-2015
 */
class Clients extends Base {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clients';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $rules = array(
        'name' => 'required|alpha',
        'fullname' => 'alpha',
        'identity' => 'required|alphanumeric',
        'contact_number' => 'numeric',
        'email' => 'email'
    );

    public function Visit() {
        return $this->hasMany('Clients','id');
    }

    public function DocType() {
        return $this->belongsTo('DocType', 'doc_type', 'id');
    }    
    
    public function StaffBelongs() {
        return $this->belongsTo('User', 'addedby_user_id', 'id');
    }   
    
}
