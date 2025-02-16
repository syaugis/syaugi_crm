<?php

namespace App\Http\Controllers;

use App\Rules\ValidCredentials;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => ['required', 'string', 'min:8', new ValidCredentials],
            'remember' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $validatedData = $validator->validated();
        $response =  $this->authService->login($validatedData);

        if (isset($response['error'])) {
            return redirect()->back()->with('error', $response['error']);
        }

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        $response = $this->authService->logout($request);

        if (isset($response['error'])) {
            return redirect()->back()->with('error', $response['error']);
        }

        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
}
