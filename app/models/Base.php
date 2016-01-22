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
 * Description of Base
 *
 * @author NAseq
 * @date 28-May-2015
 */
use Illuminate\Support\Facades\Validator;
class Base extends Eloquent {

    protected $rules = array();
    protected $errors;

    public function validate($data) {
        // make a new validator object
        $v = Validator::make($data, $this->rules);

        // check for failure
        if ($v->fails()) {
            // set errors and return false
            $this->errors = $v->errors;
            return false;
        }

        // validation pass
        return true;
    }

    public function errors() {
        return $this->errors;
    }

}
