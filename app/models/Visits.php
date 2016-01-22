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
class Visits extends Base {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'visits';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $rules = array(
        'staff_user_id' => 'required',
        'client_id' => 'required',
        'visit_date_time' => 'required|date'
    );

    public function Staff() {
        return $this->belongsTo('User', 'staff_user_id', 'id');
    }

    public function Client() {
        return $this->belongsTo('Clients', 'client_id', 'id');
    }

    public function VisitDetails() {
        return $this->hasMany('Visitdetails', 'id');
    }

}
