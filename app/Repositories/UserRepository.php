<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    /**
     * @param array $userData
     *
     * @return User|null
     */
    public function register(array $userData)
    {
        $userData['password'] = Hash::make($userData['password']);
        return User::create($userData);
    }

    /**
     * @param  $name
     *
     * @return User
     */
    public function findUserByName($name)
    {
        return User::where('name', $name)->first();
    }


    /**
     *
     * @return User
     */
    public function getAllUsers()
    {
        return User::all();
    }

    /**
     * @param int $id
     *
     * @return User
     */

    public function getUserById($id)
    {
        return User::find($id);
    }

    /**
     * @param array $userData
     * @param int $id
     * @return User
     */
    public function updateUser($userData, $id)
    {

        $user =  $this->getUserById($id);
        $userData['password'] = Hash::make($userData['password']);

        return $user->update($userData);
    }


    /**
     * @param User $user
     * @return bool
     */
    public function deleteUser($user)
    {
        return $user->delete();
    }
}
