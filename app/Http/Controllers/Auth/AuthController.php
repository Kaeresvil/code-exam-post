<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\User\UserResource;
use App\Services\Utils\ResponseServiceInterface;
use App\Services\Authentication\AuthServiceInterface;

class AuthController extends Controller
{

    // Define the properties for the AuthController
    private $authService;
    private $responseService;

    // Constructor to inject the AuthService and ResponseService
    public function __construct(AuthServiceInterface $authService, ResponseServiceInterface $responseService)
    {
        $this->authService = $authService;
        $this->responseService = $responseService;  
    }

    public function login(LoginRequest $request)
    {
        $data = $this->authService->login($request->validated());
        return $this->responseService->authResponse("Login Successful", $data);


    }

    public function register(UserRequest $request)
    {

        $result = $this->authService->register($request->validated());

        if(!is_string($result)) {
            return $this->responseService->storeResponse("User", $result);
        }else {
            return $this->responseService->rejectResponse($result, []);
        }

    }

    public function logout()
    {
       $this->authService->logout();
        return $this->responseService->authResponse("Logout Successful", []);
    }


    public function authUser()
    {
        $user = $this->authService->authUser();
        return $this->responseService->authResponse("Authentication Successful", new UserResource($user));
    }
}
