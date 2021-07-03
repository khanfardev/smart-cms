<?php

namespace App\Repositories;

interface CommentRepositoryInterface
{
    public function get();

    public function show($id);

    public function store($data,$post);

    public function update($data,$comment);

    public function delete($comment);
}
