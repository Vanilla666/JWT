<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct() //建構子
    {
        $this->middleware('auth:api')->except('login'); //中介層 除了登入 其他都要被驗證
    }
    
    public function login() //登入函數 post方式
    {
        $credentials = request(['email', 'password']); //去拿認證需要的資訊

        if (! $token = auth()->attempt($credentials)) { // 驗證憑證 attempt() 驗證使用者資料後給token
            return response()->json(['status' => 1, 'message' => 'invalid credentials'], 401); //不合法憑證
        }
        
        return response()->json(['status' => 0, 'token' => $token]); //響應 json格式  發放憑證
    }

    public function me() //登入過後我的資訊 get方式
    {
        return response()->json(auth()->user()); // 響應 json格式 使用者資訊
    }

    public function logout() //登出後把憑證失效 post方式
    {
        auth()->logout(); //登出使用者 
        return response()->json(['status' => 0]); // 響應 json格式 status 0
    }

}
