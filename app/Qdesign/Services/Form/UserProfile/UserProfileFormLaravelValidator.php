<?php namespace Qdesign\Services\Form\UserProfile;

use Qdesign\Services\Validation\AbstractLaravelValidator;

class UserProfileFormLaravelValidator extends AbstractLaravelValidator {

    /**
     * Validation rules
     *
     * @var Array
     */
    protected $rules = array(
        'first_name'  =>  'required',
        'last_name' =>  'required',
    );

}