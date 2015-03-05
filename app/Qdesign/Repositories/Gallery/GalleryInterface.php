<?php namespace Qdesign\Repositories\Gallery;

interface GalleryInterface {
    public function all();

    public function byId($id);

    public function create(array $data);

    public function update(array $data);

    public function delete($id);

}