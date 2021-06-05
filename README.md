# Projeto Cadastro de Produtos e Categorias
Projeto para praticar meu conhecimento do framework PHP - Laravel.

Demonstração do projeto online: [Clique aqui](https://appcpc.herokuapp.com/)

## Funções adicionadas ao projeto
 - Cadastro e login de usuário
 - Opção de adicionar foto de usuário
 - CRUD de produtos e outro de categorias com uma relação um para um com chave estrangeira

## Tecnologias utilzadas
- [x] Laravel v8.12
- [x] Bootstrap v4.6
- [x] Fontawesome

## Instalação
**Instale as dependências**

```$ composer install --no-scripts```

**Copie o arquivo .env.example**

```$ copy .env.example .env```

**Crie uma nova chave para a aplicação**

```$ php artisan key:generate```

**Em seguida você deve configurar o arquivo .env e rodar as migrations com:**

```$ php artisan migrate```

**Execute os comandos npm**

```$ npm install && npm run dev```