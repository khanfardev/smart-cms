<?php

namespace App\Repositories;

interface MessageRepositoryInterface
{
    public function get($paginate,$message_user);

    public function show($message);

    public function store($data);

    public function update($message, $data);

    public function delete($message);
}
