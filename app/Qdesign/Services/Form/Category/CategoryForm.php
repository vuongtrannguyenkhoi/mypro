<?php namespace Qdesign\Services\Form\Category;

use Qdesign\Services\Validation\ValidableInterface;
use Qdesign\Repositories\Category\CategoryInterface;

class CategoryForm {

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
    protected $category;

    public function __construct(ValidableInterface $validator, CategoryInterface $category)
    {
        $this->validator = $validator;
        $this->category = $category;
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
        return $this->category->create($input);
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

        return $this->category->update($input);
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