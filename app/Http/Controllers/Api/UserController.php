<?php

namespace App\Http\Controllers\Api;

use App\Member;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected function checkTeacherID($tid)
    {
        if (!$tid) return false;
        if (strlen($tid) != 11) return false;
        if ($tid[0] != 7) return false;

        $sum = 0;

        for ($i = 0; $i < 10; $i++) {
            $sum += $tid[$i] * ($i + 1);
        }

        $mod = $sum % 11;

        if ($mod != $tid[10]) return false;

        return true;
    }

    public function register(Request $request)
    {
        $input = $request->only([
            'firstname', 'lastname', 'username', 'email', 'password', 'teacher_id', 'photo'
        ]);

        $val = Validator::make($input, [
            'username' => 'unique:member,username',
            'email' => 'unique:member,email'
        ]);

        if ($val->fails()) {
            return response()->json([
                'message' => 'Member email or username already registered'
            ], 422);
        }

        if (!$this->checkTeacherID($input['teacher_id'])) {
            return response()->json([
                'message' => 'Wrong teacher ID'
            ], 422);
        }

        $input['token'] = md5($input['username']);
        $input['password'] = md5($input['password']);

        $member = Member::create($input);

        return response()->json([
            'token' => $input['token']
        ], 200);
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = md5($request->password);

        $member = Member::where([
            ['username', $username],
            ['password', $password]
        ])->first();

        if ($member) {
            $member->token = md5($username);
            $member->save();

            return response()->json([
                'token' => $member->token
            ], 200);
        }

        return response()->json([
            'message' => 'invalid login'
        ], 401);
    }

    public function logout(Request $request)
    {
        $member = Member::whereNotNull('token')->where('token', $request->token)->first();
        $member->token = '';
        $member->save();

        return response()->json([
            'message' => 'Logout success'
        ], 200);
    }
}
