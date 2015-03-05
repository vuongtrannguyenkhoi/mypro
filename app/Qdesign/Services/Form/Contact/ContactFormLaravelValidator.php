<?php namespace Qdesign\Services\Form\Contact;

use Qdesign\Services\Validation\AbstractLaravelValidator;

class ContactFormLaravelValidator extends AbstractLaravelValidator {

    /**
     * Validation rules
     *
     * @var Array
     */
    protected $rules = array(
        'name'      => 'required',
        'phone'      => 'required',
        'email' 	=>  'email',
        'body' 	=>  'required',
    );

}