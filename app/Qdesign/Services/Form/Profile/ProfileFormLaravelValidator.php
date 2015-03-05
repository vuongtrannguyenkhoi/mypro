<?php namespace Qdesign\Services\Form\Profile;

use Qdesign\Services\Validation\AbstractLaravelValidator;

class ProfileFormLaravelValidator extends AbstractLaravelValidator {

    /**
     * Validation rules
     *
     * @var Array
     */
    protected $rules = array(
        'full_name'  =>  'required',
        'content' =>  'required',
    );

}