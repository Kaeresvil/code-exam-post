<?php

namespace App\Repository\User;

use App\Models\User;
use App\Repository\Base\BaseRepository;
use Illuminate\Validation\ValidationException;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

     public function getUserByEmail(string $email): User
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            return $user;
        } else {
            throw ValidationException::withMessages([
                'user_not_found' => 'User not found'
            ]);
        }
    }
}
