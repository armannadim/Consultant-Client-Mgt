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
class Visitdetails extends Base {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'visitdetails';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function Visit() {
        return $this->belongsTo('Visits');
    }

}
