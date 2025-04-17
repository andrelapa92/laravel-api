# Projeto Laravel API - Integração com API Externa

Este projeto foi desenvolvido como parte de um teste técnico. Ele consiste em uma API REST criada com Laravel, que atua como intermediária entre o frontend e uma API externa.

## Tecnologias Utilizadas

- PHP 8.2 (Laravel Framework)
- MySQL 8
- Nginx
- Docker e Docker Compose
- Node.js 18 / Vite (para assets frontend)

## Funcionalidades

- CRUD de usuários
- CRUD de endereços vinculados aos usuários
- Listagem paginada de dados
- Consumo de API externa (viaCEP)
- Interface web simples para visualização e edição

## Endpoints Disponíveis (API REST)

### Usuários

- `GET /api/users` - Listar todos os usuários (paginado)
- `GET /api/users/{id}` - Detalhes de um usuário
- `POST /api/users` - Criar um novo usuário
- `PUT /api/users/{id}` - Atualizar um usuário existente
- `DELETE /api/users/{id}` - Excluir um usuário

### Endereços (relacionados ao usuário)

- `GET /api/users/{id}/addresses` - Listar endereços de um usuário
- `POST /api/users/{id}/addresses` - Criar novo endereço
- `PUT /api/addresses/{id}` - Atualizar endereço existente
- `DELETE /api/addresses/{id}` - Excluir endereço

## Como Executar Localmente

### Requisitos

- Docker

### Passos

```bash
git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio
docker compose up --build
```

A aplicação estará acessível em `http://localhost:8080`

## Scripts de Inicialização

O container executa automaticamente o script `start.sh`, que:

- Instala dependências com `npm install`
- Executa `npm run dev` (Vite)
- Sobe o servidor Laravel com `php artisan serve`

## Deploy

Este projeto está configurado para ser executado com Nginx + PHP-FPM. O `default.conf` já define o webserver com rewrite para o Laravel corretamente:

```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

Basta apontar o `root` do Nginx para `/public` e garantir permissões adequadas.

## Observações Finais

- As migrations são executadas automaticamente no primeiro start
- Padrões RESTful seguidos com status HTTP adequados
- Projeto modularizado com controllers separados
- Pronto para deploy em servidor Ubuntu com Apache/Nginx

---

Em caso de dúvidas ou sugestões, entre em contato!

---

**Desenvolvido por:** André Lapa

**LinkedIn:** [https://www.linkedin.com/in/andreluizlapa/](https://www.linkedin.com/in/andreluizlapa/)

**GitHub:** [https://github.com/andrelapa92](https://github.com/andrelapa92)
