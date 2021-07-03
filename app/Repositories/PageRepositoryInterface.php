<?php

namespace App\Repositories;

interface PageRepositoryInterface
{
    public function get();

    public function show($id);

    public function store($data);

    public function update($user, $data);

    public function delete($user);
}
