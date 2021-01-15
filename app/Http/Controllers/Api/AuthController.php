<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\LoginRequest;
use App\Models\Log;

class AuthController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!$token = auth()->attempt($credentials)) {
            Log::insert(
                null,
                null,
                Log::ContentType_User,
                Log::Action_InvalidLogin,
                $credentials
            );

            return $this->response->setCode(401)
                ->setMessage('Bilgileri kontrol edip tekrar deneyin!')->respond();
        }

        Log::insert(
            auth()->user()->id,
            auth()->user()->id,
            Log::ContentType_User,
            Log::Action_Login
        );

        return $this->createNewToken($token);
    }

    public function refresh()
    {
        Log::insert(
            auth()->user()->id,
            auth()->user()->id,
            Log::ContentType_User,
            Log::Action_RefreshToken
        );

        return $this->createNewToken(auth()->refresh());
    }

    public function logout()
    {
        Log::insert(
            auth()->user()->id,
            auth()->user()->id,
            Log::ContentType_User,
            Log::Action_Logout
        );

        auth()->logout();

        return $this->response->setCode(200)
            ->setMessage('İşlem başarılı.')->respond();
    }

    private function createNewToken($token)
    {
        $data = [
            'access_token' => $token,
        ];

        return $this->response->setCode(200)
            ->setMessage('İşlem başarılı.')->setData($data)->respond();
    }
}
