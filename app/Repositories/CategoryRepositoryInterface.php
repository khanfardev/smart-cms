<?php

namespace App\Repositories;

interface CategoryRepositoryInterface
{
    public function get($filter);

    public function show($id);

    public function store($data);

    public function update($user, $data);

    public function delete($user);
}
