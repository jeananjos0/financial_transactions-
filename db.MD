# Base de dados 🐘

## Tabela de Usuários (users):

<strong style="color:green">id:</strong> Uma chave primária única para identificar cada usuário. Auto-incrementada para cada novo usuário.</br>
<strong style="color:green">role_id:</strong>  A chave estrangeira que se refere ao id da tabela de permissão.</br>
<strong style="color:green">fullname:</strong> O nome completo do usuário.</br>
<strong style="color:green">cpf_cnpj:</strong> O número de CPF (para indivíduos) ou CNPJ (para lojistas) do usuário. Deve ser único para cada usuário.</br>
<strong style="color:green">email:</strong> O endereço de e-mail do usuário. Deve ser único para cada usuário.</br>
<strong style="color:green">password:</strong> A hash da senha do usuário, usada para autenticação.</br>
<strong style="color:green">wallet_balance:</strong> O saldo atual na carteira do usuário. Pode aumentar quando o usuário recebe dinheiro e diminuir quando o usuário envia dinheiro.</br>
<strong style="color:green">created_at:</strong> A data e a hora em que a conta do usuário foi criada.</br>
<strong style="color:green">updated_at:</strong> A última data e hora em que os detalhes da conta do usuário foram atualizados.</br>


## Tabela de Permições (Roles):

<strong style="color:green">id:</strong> Uma chave primária única para identificar cada usuário. Auto-incrementada para cada novo usuário.</br>
<strong style="color:green">description:</strong> Descrição do nível de permissão do usuário.</br>
<strong style="color:green">created_at:</strong> A data e a hora em que a conta do usuário foi criada.</br>
<strong style="color:green">updated_at:</strong> A última data e hora em que os detalhes da conta do usuário foram atualizados.</br>



## Tabela de Transações (transactions):

<strong style="color:green">id:</strong> Uma chave primária única para identificar cada transação. Auto-incrementada para cada nova transação.</br>
<strong style="color:green">sender_id:</strong> A chave estrangeira que se refere ao id do usuário que está enviando dinheiro na transação.</br>
<strong style="color:green">recipient_id:</strong> A chave estrangeira que se refere ao id do usuário que está recebendo dinheiro na transação.</br>
<strong style="color:green">amount:</strong> A quantia de dinheiro sendo transferida na transação.</br>
<strong style="color:green">transaction_date:</strong> A data e a hora em que a transação ocorreu.</br>
<strong style="color:green">status:</strong> O status atual da transação. Pode ser 'pending', 'complete' ou 'failed'.</br>
<strong style="color:green">created_at:</strong> A data e a hora em que a transação foi criada.</br>
<strong style="color:green">updated_at:</strong> A última data e hora em que os detalhes da transação foram atualizados.</br>

## Tabela de Notificações (notifications):

<strong style="color:green"> id:</strong> Uma chave primária única para identificar cada notificação. Auto-incrementada para cada nova notificação. </br>
<strong style="color:green"> user_id: </strong> A chave estrangeira que se refere ao id do usuário que está recebendo a notificação. </br>
<strong style="color:green"> transaction_id: </strong> A chave estrangeira que se refere ao id da transação que desencadeou a notificação. </br>
<strong style="color:green"> message: </strong> A mensagem da notificação. </br>
<strong style="color:green"> sent_at: </strong> A data e a hora em que a notificação foi enviada. </br>
<strong style="color:green"> created_at: </strong> A data e a hora em que a notificação foi criada. </br>
<strong style="color:green"> updated_at: </strong> A última data e a hora em que os detalhes da notificação foram atualizados. </br>