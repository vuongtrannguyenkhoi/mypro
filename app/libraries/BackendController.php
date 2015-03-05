<?php namespace App\Libraries;
use Qdesign\Models\Category;
use Qdesign\Repositories\Category\EloquentCategory;

class BackendController extends BaseController {

    public function __construct()
    {
        $this->category = new EloquentCategory(new Category);
        $this->data['postCategories'] = $this->category->getCategoriesHaveController('posts');
    }
}