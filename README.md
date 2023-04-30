# Sistema de Transações Financeiras
Este projeto implementa um sistema de transações financeiras online entre dois tipos de usuários: 
usuários comuns e lojistas. A aplicação foi desenvolvida utilizando React.js (TypeScript) para o frontend e Laravel para o backend.

## Funcionalidades
O sistema oferece as seguintes funcionalidades:

<strong style="color:#2e9ae7"> Cadastro de usuários:</strong> O sistema permite o cadastro de usuários
 comuns e lojistas, exigindo Nome Completo, CPF ou CNPJ, e-mail e Senha. Cada CPF/CNPJ e e-mail deve
  ser único no sistema.

<strong style="color:#2e9ae7">Transferências entre usuários:</strong> Os usuários podem efetuar 
transferências entre eles e para lojistas. As transferências são validadas para garantir que o usuário
 tem saldo suficiente antes de serem processadas.

<strong style="color:#2e9ae7">Limitações para lojistas:</strong> Lojistas só podem receber transferências,
 não podendo enviar dinheiro para ninguém.

<strong style="color:#2e9ae7">Serviço de autorização externo:</strong> Antes de concluir a transferência, o sistema consulta um serviço autorizador externo para garantir a segurança da transação.

<strong style="color:#2e9ae7">Garantia de transação:</strong> Cada operação de transferência é tratada como uma transação, garantindo que o dinheiro seja revertido para a carteira do usuário em caso de qualquer inconsistência.

<strong style="color:#2e9ae7">Notificações de pagamento:</strong> Ao receber um pagamento, o usuário ou lojista recebe uma notificação através de um serviço de terceiros. O sistema é robusto o suficiente para lidar com a eventual indisponibilidade ou instabilidade deste serviço de terceiros.

<br>

# Como Rodar o Projeto
git clone https://github.com/jeananjos0/financial_transactions.git

cd financial_transactions

docker-compose up -d

O frontend estará disponível em http://localhost:3000 e o backend em http://localhost:8000.

<br>

# Licença
Este projeto está sob a licença gratuita (free license). Você pode usá-lo, modificá-lo e redistribuí-lo gratuitamente. 

Este projeto foi desenvolvido com muito cuidado e atenção aos detalhes para garantir transações seguras e eficientes entre usuários e lojistas. Agradecemos o seu interesse e estamos abertos a sugestões e contribuições!
