<?php namespace Qdesign\Services\Form\Gallery;

use Qdesign\Services\Validation\AbstractLaravelValidator;

class GalleryFormLaravelValidator extends AbstractLaravelValidator {

    /**
     * Validation rules
     *
     * @var Array
     */
    protected $rules = array(
        'name'  =>  'required',
    );

}