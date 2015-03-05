<?php namespace Qdesign\Repositories\Order;

interface OrderInterface {
    public function all();

    public function byId($id);

    public function create(array $data);

    public function update(array $data);

    public function delete($id);

}