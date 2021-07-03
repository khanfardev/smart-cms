<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository implements UserRepositoryInterface
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function get()
    {
        return $this->user->paginate(10);
    }
    public function getUser($email){
        return $this->user->where('email', $email)->first();
    }
    public function show($user)
    {
        return $user;
    }

    public function store($data)
    {
        $data['password'] = Hash::make($data['password']);
        $current = $this->user->create($data);
        $current->assignRole('user');
        return $current;
    }

    public function update($id, $data)
    {
        return $this->show($id)->update($data);
    }

    public function delete($id)
    {
        return $this->show($id)->delete();
    }
}
