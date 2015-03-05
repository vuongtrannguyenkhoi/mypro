<?php namespace Qdesign\Services\Form\Topic;

use Qdesign\Services\Validation\AbstractLaravelValidator;

class TopicFormLaravelValidator extends AbstractLaravelValidator {

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