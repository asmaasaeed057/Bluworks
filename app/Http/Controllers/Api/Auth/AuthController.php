<?php

namespace App\Http\Controllers\Api\Auth;

use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Controllers\Api\BaseController as BaseController;
use Exception;

class AuthController extends BaseController
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
     * Register User
     * @param RegisterRequest $request
     * @return \Illuminate\Http\Response 
     */
    public function register(RegisterRequest $request)
    {
        try {
            $user = $this->userService->register($request->all());
            if (!$user) {
                return $this->sendError('Error validation', 'Fialed to register a new user.');
            }
            $success['token'] = $user->createToken("API TOKEN")->plainTextToken;
            $success['user'] =  $user;
            return $this->sendResponse($success, 'User created successfully.');
        } 
        catch (Exception $e) {
            return $this->sendError('Someting wrong!', $e->getMessage(), $e->getCode());
        }
    }

    /**
     * Login User
     * @param LoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        try {
            if (!Auth::attempt($request->only(['name', 'password']))) {
                return $this->sendError('Unauthorized.', ['error' => 'Unauthorized'], 401);
            } else {
                $user = $this->userService->findUserByName($request->name);
                $success['token'] =  $user->createToken("API TOKEN")->plainTextToken;
                $success['user'] =  $user;
                return $this->sendResponse($success, 'User Logged In Successfully.');
            }
        } 
        catch (Exception $e) {
            return $this->sendError('Someting wrong!', $e->getMessage(), $e->getCode());
        }
    }
}
