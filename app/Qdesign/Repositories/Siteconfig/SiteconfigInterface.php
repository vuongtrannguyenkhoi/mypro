<?php namespace Qdesign\Repositories\Siteconfig;

interface SiteconfigInterface {
    public function all();

    public function byId($id);

    public function create(array $data);

    public function update(array $data);

    public function delete($id);

}