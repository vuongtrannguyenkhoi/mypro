<?php namespace Qdesign\Services\Form\User;

use Qdesign\Services\Validation\AbstractLaravelValidator;

class UserFormLaravelValidator extends AbstractLaravelValidator {

    /**
     * Validation rules
     *
     * @var Array
     */
    public $rules = array();

    public  $createRules = array(
        'username'  =>  'required|unique:users',
        'email'     =>  'email|unique:users',
        'password' =>  'required|confirmed'
    );

    public  $updateRules = array(
        'password' =>  'confirmed'
    );

}