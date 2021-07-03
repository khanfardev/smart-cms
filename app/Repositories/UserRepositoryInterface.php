<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function get();

    public function show($id);
    public function getUser($email);
    public function store($data);

    public function update($user, $data);

    public function delete($user);
}
