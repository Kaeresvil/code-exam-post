<?php

namespace App\Services\Authentication;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Repository\User\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AuthService implements AuthServiceInterface
{

    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * Login method for user authentication.
     */
    public function login(array $data)
    {

        $user = $this->userRepository->getUserByEmail($data['email']);

        if (Auth::attempt($data)) {
            return [
                'token' => $user->createToken('token-name')->plainTextToken,
                'user' => $user
            ];
        } else {
            throw ValidationException::withMessages([
                'invalid_user_name_or_password' => "Invalid Email or Password"
            ]);
        }
    }

    public function logout()
    {

        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return $user;

    }


    public function register(array $data)
    {

        try {

             $user = User::create($data);
             DB::commit();
             return $user;
            
        } catch (ValidationException $e) {
           DB::rollBack();
           return $e->getMessage();
        }

     
    }

    public function authUser()
    {
        return Auth::user();
    }


}