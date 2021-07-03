<?php

namespace App\Repositories;

interface PostRepositoryInterface
{
    public function get();

    public function show($id);
    public function myPosts();
    public function listPosts();
    public function showPost($post);
    public function store($data);

    public function update($post, $data);

    public function delete($post);
}
