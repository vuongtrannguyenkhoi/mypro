<?php namespace Qdesign\Services\Form\Post;

use Qdesign\Services\Validation\AbstractLaravelValidator;

class PostFormLaravelValidator extends AbstractLaravelValidator {

    /**
     * Validation rules
     *
     * @var Array
     */
    protected $rules = array(
        'name'  =>  'required',
        'slug'  =>  'required',
    );

}