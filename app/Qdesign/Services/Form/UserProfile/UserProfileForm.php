<?php namespace Qdesign\Services\Form\UserProfile;

use Qdesign\Services\Validation\ValidableInterface;
use Qdesign\Repositories\UserProfile\UserProfileInterface;

class UserProfileForm {

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
    protected $layout;

    public function __construct(ValidableInterface $validator, UserProfileInterface $layout)
    {
        $this->validator = $validator;
        $this->layout = $layout;
    }

    /**
     * Create an new article
     *
     * @return boolean
     */
    public function save(array $input)
    {
        if( ! $this->valid($input) )
        {
            return false;
        }
        return $this->layout->create($input);
    }

    /**
     * Update an existing article
     *
     * @return boolean
     */
    public function update(array $input)
    {
        if( ! $this->valid($input) )
        {
            return false;
        }

        return $this->layout->update($input);
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