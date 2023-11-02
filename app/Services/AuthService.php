<?php

namespace App\Services;

use App\Dto\ResponseDto;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    private UserRepository $userRepository;
    private ResponseDto $responseDto;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->responseDto = new ResponseDto();
    }

    public function signIn($email, $password): ResponseDto
    {
        $user = $this->userRepository->findByEmail($email);

        if ($user) {
            $passwordMatch = Hash::check($password, $user->password);

            if ($passwordMatch) {
                session(array(
                    'id' => $user->id,
                    'role_id' => $user->role_id,
                    'email' => $user->email,
                ));

                $this->responseDto->data = 'Success sign in';
                return $this->responseDto;
            }
        }

        $this->responseDto->status = false;
        $this->responseDto->data = 'Invalid email or password';
        return $this->responseDto;
    }

    public function changePassword($email, $password): ResponseDto
    {
        $user = $this->userRepository->findByEmail($email);

        if ($user) {
            $result = $this->userRepository->changePassword($user->id, password_hash($password, PASSWORD_BCRYPT));

            if ($result) {
                $this->responseDto->data = 'Success ganti password, silakan sign in kembali';
                return $this->responseDto;
            } else {
                $this->responseDto->data = 'Failed ganti password';
                return $this->responseDto;
            }
        }

        $this->responseDto->status = false;
        $this->responseDto->data = 'Email not registered';
        return $this->responseDto;
    }
}
