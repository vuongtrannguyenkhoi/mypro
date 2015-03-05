<?php namespace Qdesign\Services\Form\User;

use Qdesign\Services\Validation\ValidableInterface;
use Qdesign\Repositories\User\UserInterface;

class UserForm {

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

    /**
     * Article repository
     *
     * @var \Impl\Repo\Article\ArticleInterface
     */
    protected $user;

    public function __construct(ValidableInterface $validator, UserInterface $user)
    {
        $this->validator = $validator;
        $this->user = $user;
    }

    /**
     * Create an new article
     *
     * @return boolean
     */
    public function save(array $input)
    {
        if( ! $this->validCreate($input) )
        {
            return false;
        }
        return $this->user->create($input);
    }

    /**
     * Update an existing article
     *
     * @return boolean
     */
    public function update(array $input)
    {
        if( ! $this->validUpdate($input) )
        {
            return false;
        }

        return $this->user->update($input);
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

    protected function validCreate(array $input){
        $this->validator->rules = $this->validator->createRules;
        return $this->valid($input);
    }

    protected function validUpdate(array $input){
        $this->validator->rules = $this->validator->updateRules;

        return $this->valid($input);
    }
}