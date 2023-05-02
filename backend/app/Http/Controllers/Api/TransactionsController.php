<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class TransactionsController extends Controller
{
    public function store(TransactionRequest $request)
    {
        // Valida os dados da requisição e retorna um array associativo.
        $validatedData = $request->validated();

        // Encontra o usuário remetente pelo ID.
        $sender = User::find($validatedData['sender_id']);

        // Encontra o usuário destinatário pelo ID.
        $recipient = User::find($validatedData['recipient_id']);

        // Verifica se o remetente tem saldo suficiente para a transferência.
        if ($sender->wallet_balance < $validatedData['amount']) {
            return response()->json(['message' => 'Saldo insuficiente'], 400);
        }

        // Faz uma requisição GET para o serviço de autorização de transações.
        $authorizerResponse = Http::get('https://run.mocky.io/v3/f2fe9a2d-090f-4129-b9bf-70d283c97d5c');

        // Se a requisição falhar, retorna um erro.
        if ($authorizerResponse->failed()) {
            return response()->json(['message' => 'Erro ao autorizar a transferência'], 500);
        }

        // Cria uma nova instância do modelo Transactions com os dados validados.
        $transaction = new Transactions($validatedData);

        // Define a data da transação como o momento atual.
        $transaction->transaction_date = now();

        // Tenta salvar a transação no banco de dados.
        try {
            $transaction->save();

            // Subtrai o valor da transferência do saldo do remetente.
            $sender->wallet_balance -= $validatedData['amount'];
            $sender->save();

            // Adiciona o valor da transferência ao saldo do destinatário.
            $recipient->wallet_balance += $validatedData['amount'];
            $recipient->save();

            // Faz uma requisição GET para o serviço de notificações.
            $notificationResponse = Http::get('https://run.mocky.io/v3/4ce65eb0-2eda-4d76-8c98-8acd9cfd2d39');

            // Se a requisição falhar, implementar lógica para tentar enviar a notificação novamente mais tarde.
            if ($notificationResponse->failed()) {

                // Implementar lógica para tentar enviar a notificação novamente mais tarde

            }

            // Retorna uma mensagem de sucesso.
            return response()->json(['message' => 'Transferência realizada com sucesso']);
        } catch (\Exception $e) {
            // Se algum erro ocorrer ao salvar a transação, retorna uma mensagem de erro.
            return response()->json(['message' => 'Erro ao realizar a transferência'], 500);
        }
    }
}
