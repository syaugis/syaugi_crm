<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(array $vaildatedData)
    {
        $user = $this->userRepository->getByEmail($vaildatedData['email']);

        try {
            Auth::login($user, $vaildatedData['remember'] ?? false);
        } catch (Exception $e) {
            Log::error('Error when login: ' . $e->getMessage());

            return ['error' => 'Terjadi kesalahan saat masuk'];
        }
    }

    public function logout()
    {
        try {
            Auth::logout();
        } catch (Exception $e) {
            Log::error('Error when logout: ' . $e->getMessage());

            return ['error' => 'Terjadi kesalahan saat keluar'];
        }
    }
}
