<?php namespace Qdesign\Repositories\UserProfile;

interface UserProfileInterface {

    public function create(array $data);

    public function update(array $data);
}