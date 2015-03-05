<?php namespace Qdesign\Services\Form\Controller;

use Qdesign\Services\Validation\ValidableInterface;
use Qdesign\Repositories\Controller\ControllerInterface;

class ControllerForm {

    /**
     * Form Data
     *
     * @var array
     */
    protected $data;


    /**
     * @var \Qdesign\Services\Validation\ValidableInterface
     */
    protected $validator;


    /**
     * @var \Qdesign\Repositories\Controller\ControllerInterface
     */
    protected $controller;

    public function __construct(ValidableInterface $validator, ControllerInterface $controller)
    {
        $this->validator = $validator;
        $this->controller = $controller;
    }

    /**
     * @param array $input
     * @return bool
     */
    public function save(array $input)
    {
        if( ! $this->valid($input) )
        {
            return false;
        }
        return $this->controller->create($input);
    }


    /**
     * @param array $input
     * @return bool
     */
    public function update(array $input)
    {
        if( ! $this->valid($input) )
        {
            return false;
        }

        return $this->controller->update($input);
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

    /**
     * @param array $input
     * @return mixed
     */
    protected function valid(array $input)
    {
        return $this->validator->with($input)->passes();
    }
}