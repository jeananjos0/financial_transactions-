<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index()
    {
        $users = User::paginate();
        return UserResource::collection($users);
    }


    public function store(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'role_id' => 'required|numeric',
            'fullname' => 'required',
            'cpf_cnpj' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'wallet_balance' => 'required',
        ]);
        if ($validator->fails()) return response()->json(['status' => 0, 'msg' => $validator->errors()]);

        try {
            $Store_ = new User();
            $Store_->role_id = $req->role_id;
            $Store_->fullname = $req->fullname;
            $Store_->cpf_cnpj = $req->cpf_cnpj;
            $Store_->email = $req->email;
            $Store_->password = $req->password;
            $Store_->wallet_balance = $req->wallet_balance;
            $Store_->save();
            if ($Store_->save()) {

                return response()->json(['status' => 1, 'msg' => "Salvo com sucesso."]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'msg' => $e]);
        }
    }
}
