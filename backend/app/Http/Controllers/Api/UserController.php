<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function index()
    {
        // Recupera uma lista paginada de usuários com 10 usuários por página.
        $users = User::paginate(20);
        // Retorna a lista de usuários como uma resposta JSON.
        return response()->json($users);
    }


    public function store(UserRequest $request)
    {
        try {
            // Cria um novo usuário.
            $user = new User();
            // Preenche os dados do usuário com os dados fornecidos pelo usuário.
            $user->fill($request->all());
            // Cria a senha do usuário como uma hash de senha.
            $user->password = Hash::make($request->password);
            // Salva o usuário criado.
            $user->save();

            // Retorna uma resposta JSON com uma mensagem de sucesso e o status 201 (Created).
            return response()->json(['status' => 1, 'message' => 'Usuário criado com sucesso.'], 201);
        } catch (\Exception $e) {
            // Registra o erro no log do aplicativo.
            Log::error('Erro ao criar usuário: ' . $e->getMessage());

            // Retorna uma resposta JSON com uma mensagem de erro e o status 500 (Internal Server Error).
            return response()->json(['status' => 0, 'message' => 'Falha ao criar o usuário.'], 500);
        }
    }

    public function update(UserRequest $request, $id)
    {
        try {
            // Recupera um usuário com o id fornecido pelo usuário.
            $user = User::findOrFail($id);
            // Atualiza os dados do usuário com os dados fornecidos pelo usuário.
            $user->fill($request->all());
            // Cria a senha do usuário como uma hash de senha.
            $user->password = Hash::make($request->password);
            // Salva as alterações feitas no usuário.
            $user->save();

            // Retorna uma resposta JSON com uma mensagem de sucesso.
            return response()->json(['status' => 1, 'message' => 'Usuário atualizado com sucesso.']);
        } catch (\Exception $e) {
            // Registra o erro no log do aplicativo.
            Log::error('Erro ao atualizar usuário: ' . $e->getMessage());

            // Retorna uma resposta JSON com uma mensagem de erro e o status 500 (Internal Server Error).
            return response()->json(['status' => 0, 'message' => 'Falha ao atualizar o usuário.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            // Remove o usuário do banco de dados.
            $user = User::where(['id' => $id])->update(['active' => 0]);

            // Retorna uma resposta JSON com uma mensagem de sucesso.
            return response()->json(['status' => 1, 'message' => 'Usuário  excluído com sucesso.']);
        } catch (\Exception $e) {
            // Registra o erro no log do aplicativo.
            Log::error('Erro ao excluir usuário: ' . $e->getMessage());

            // Retorna uma resposta JSON com uma mensagem de erro e o status 500 (Internal Server Error).
            return response()->json(['status' => 0, 'message' => 'Falha ao excluir o usuário.'], 500);
        }
    }
}
