<?php

namespace App\Services\Authentication;

interface AuthServiceInterface
{
    public function login(array $data);
    public function logout();
    public function register(array $data);
    public function authUser();

}
// This interface defines the contract for authentication services, including methods for login.