<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Repositories\UserRepository;

class UserService
{
    /**
     * @var UserRepository $userRepo
     */
    protected $userRepo;


    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Create new user.
     *
     * @param array $userData
     *
     * @return User
     */
    public function register(array $userData): ?User
    {
        return $this->userRepo->register($userData);
    }


    /**
     * Find  user by name.
     *
     * @param $name
     *
     * @return User
     */
    public function findUserByName($name): ?User
    {
        return $this->userRepo->findUserByName($name);
    }



    /**
     * Get all users.
     *
     * @return User
     */
    public function getAllUsers()
    {
        return $this->userRepo->getAllUsers();
    }


    /**
     * Find  user by id.
     *
     * @param int $id
     *
     * @return User
     */
    public function getUserById($id)
    {
        return $this->userRepo->getUserById($id);
    }


    /**
     * Update  user .
     *
     * @param array $userData
     * @param int $id
     *
     * @return User
     */
    public function  updateUser(array $userData ,int $id)
    {
        return $this->userRepo->updateUser($userData,$id);

    }

  /**
     * Delete  user .
     *
     * @param User $user
     *
     * @return bool
     */
    public function  deleteUser($user)
    {
        return $this->userRepo->deleteUser($user);

    }
    
}
