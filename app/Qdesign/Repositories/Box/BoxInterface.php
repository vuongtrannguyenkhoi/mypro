<?php namespace Qdesign\Repositories\Box;

interface BoxInterface {
    public function all();

    public function byId($id);

    public function create(array $data);

    public function update(array $data);

    public function delete($id);

}