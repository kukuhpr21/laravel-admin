<?php

namespace App\Http\Controllers;

use App\Dto\ResponseDto;
use App\Http\Requests\SignInValidation;
use App\Services\AuthService;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function signIn()
    {
        return view('pages.auths.signin');
    }

    public function doSignIn(SignInValidation $request)
    {
        if ($request->validated()) {
            $result = $this->authService->signIn($request->email, $request->password);

            if ($result->status) {
                return redirect('dashboard');
            }
            return redirect('signin')->with('failed', $result->data);
        }
    }

    public function changePassword()
    {
        return view('pages.auths.changepassword');
    }

    public function doChangePassword(SignInValidation $request)
    {
        if ($request->validated()) {
            $result = $this->authService->changePassword($request->email, $request->password);

            if ($result->status) {
                return redirect('signin')->with('success', $result->data);
            } else {
                return redirect('change-password')->with('failed', $result->data);
            }
        }
    }

    public function signout()
    {
        session()->flush();
        return redirect('/');
    }
}
