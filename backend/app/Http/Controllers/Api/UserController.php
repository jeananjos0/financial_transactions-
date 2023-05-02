<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index()
    {
        $users = User::paginate(10);
        return $users;
    }


    public function create(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'role_id' => 'required',
            'fullname' => 'required',
            'cpf_cnpj' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'wallet_balance' => 'required',
        ]);
        if ($validator->fails()) return response()->json(['status' => 0, 'msg' => $validator->errors()]);

        try {
            $create = new User();
            $create->role_id = $req->role_id;
            $create->fullname = $req->fullname;
            $create->cpf_cnpj = $req->cpf_cnpj;
            $create->email = $req->email;
            $create->password = $req->password;
            $create->wallet_balance = $req->wallet_balance;
            $create->save();
            if ($create->save()) {

                return response()->json(['status' => 1, 'msg' => "Salvo com sucesso."]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'msg' => $e]);
        }
    }


    public function edit(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'role_id' => 'required',
            'fullname' => 'required',
            'cpf_cnpj' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'wallet_balance' => 'required',
        ]);

        if ($validator->fails()) return response()->json(['status' => 0, 'msg' => $validator->errors()]);

        try {
            $edit =  User::where(['id' => $req->id])->update([
                'role_id' => $req->role_id,
                'fullname' => $req->fullname,
                'cpf_cnpj' => $req->cpf_cnpj,
                'email' => $req->email,
                'password' => $req->password,
                'wallet_balance' => $req->wallet_balance,
            ]);
            if ($edit) {
                return response()->json(['status' => 1, 'msg' => "Editado com sucesso."]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'msg' => $e]);
        }
    }

    public function delete(Request $req)
    {
        try {
            $edit =  User::where(['id' => $req->id])->update([
                'active' => 0,
            ]);
            if ($edit) {
                return response()->json(['status' => 1, 'msg' => "Deletado com sucesso."]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'msg' => $e]);
        }
    }
}
