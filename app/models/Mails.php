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
 * @date 18-Jan-2016
 */
class Mails extends Base {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mail';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function Sender(){
        return $this->belongsTo('User', 'sender', 'id');
    }
    
    public function Receiver(){
        return $this->belongsTo('User', 'receiver', 'id');
    }
}
