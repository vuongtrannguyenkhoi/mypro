<?php namespace Qdesign\Repositories\Photo;

interface PhotoInterface {
    public function all();

    public function byId($id);

    public function create(array $data);

    public function update(array $data);

    public function delete($id);

    public function findByGallery($gallery);

}