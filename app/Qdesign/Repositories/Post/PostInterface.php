<?php namespace Qdesign\Repositories\Post;

interface PostInterface {
    public function all();

    public function byId($id);

    public function create(array $data);

    public function update(array $data);

    public function delete($id);

    public function publishedPosts( $page, $limit, $category_slug);

}