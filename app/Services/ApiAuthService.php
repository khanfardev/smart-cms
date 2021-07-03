<?php


namespace App\Services;


use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ApiAuthService
{
    private $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }
    public function getAuthenticatedUser(){
        return $this->repo->show(Auth()->user()->id);
    }
    public function loginUser($data){
        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
            $user = $this->repo->getUser($data['email']);
            if (!$user->hasRole('user')) {
                return response()->json(['message' => 'Invalid login details'], 401);
            }
            $token = $user->createToken('auth_token', ['*'], $data['notification_token'] ?? null)->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ]);
        }
    }
    public function registerUser($data){
    return $this->repo->store($data);

    }
    public function logout()
    {
        auth()->user()->tokens()->delete();

    }

}
