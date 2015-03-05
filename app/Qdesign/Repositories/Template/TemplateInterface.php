<?php namespace Qdesign\Repositories\Template;

interface TemplateInterface {
    public function all();

    public function byId($id);

    public function create(array $data);

    public function update(array $data);

    public function delete($id);

}