<?php namespace Qdesign\Services\Form\Contact;

use Qdesign\Services\Validation\ValidableInterface;

class ContactForm {

    /**
     * Form Data
     *
     * @var array
     */
    protected $data;

    /**
     * Validator
     *
     * @var \Impl\Form\Service\ValidableInterface
     */
    protected $validator;
    
    public function __construct(ValidableInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Create an new article
     *
     * @return boolean
     */
    public function validate(array $input)
    {
        if( ! $this->valid($input) )
        {
            return false;
        }
        return true;
    }
    
    /**
     * Return any validation errors
     *
     * @return array
     */
    public function errors()
    {
        return $this->validator->errors();
    }

    protected function valid(array $input)
    {
        return $this->validator->with($input)->passes();
    }
}