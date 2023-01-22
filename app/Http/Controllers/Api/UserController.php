<?php

namespace App\Http\Controllers\Api;

use App\Services\UserService;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Controllers\Api\BaseController as BaseController;

use Exception;

class UserController extends BaseController
{

    /**
     * @var UserService $userService
     */
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a list of users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            $users = $this->userService->getAllUsers();
            if (!$users) {
                return $this->sendError('No users available!', [], 404);
            }
            $success['users'] = $users;
            return $this->sendResponse($success, 'Users retrieved successfully.');
        } 
        catch (Exception $e) {
            return $this->sendError('Someting wrong!', $e->getMessage(), $e->getCode());
        }
    }


    /**
     * Display specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = $this->userService->getUserById($id);
            if (!$user) {
                return $this->sendError('User not found!', [], 404);
            }
            $success['user'] = $user;
            return $this->sendResponse($success, 'User retrieved successfully.');
        } 
        catch (Exception $e) {
            return $this->sendError('Someting wrong!', $e->getMessage(), $e->getCode());
        }
    }

    /**
     * Update the specified user.
     *
     * @param  UpdateUserRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $user = $this->userService->getUserById($id);

            if (!$user) {
                return $this->sendError('User not found!', [], 404);
            }
            $this->userService->updateUser($request->all(), $id);
            $success['user'] = $user;
            return $this->sendResponse($success, 'User update successfully.');
        } 
        catch (Exception $e) {
            return $this->sendError('Someting wrong!', $e->getMessage(), $e->getCode());
        }
    }



    /**
     * Remove the user .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = $this->userService->getUserById($id);
            if (!$user) {
                return $this->sendError('User not found!', [], 404);
            }

            $this->userService->deleteUser($user);
            return $this->sendResponse('', 'User deleted successfully.');
        } 
        catch (Exception $e) {
            return $this->sendError('Someting wrong!', $e->getMessage(), $e->getCode());
        }
    }
}
