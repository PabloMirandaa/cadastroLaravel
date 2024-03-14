## Como rodar o projeto baixado
Instalar as dependencias do PHP
```
composer install
```

Instalar as dependencias do Node.js
```
npm install
```

Duplicar o arquivo ".env.example" e renomear para ".env"

Gerar a chave:
```
php artisan key:generate
```

Executar a migration
```
php artisan migrate
```

Iniciar o projeto criado com Laravel
```
php artisan serve
```

Acessar o conteúdo padrão do Laravel
```
http:http://127.0.0.1:8000/
```

## Sequencia para criar o projeto
Criar o projeto com Laravel
```
composer create-project laravel/laravel larel-meu-projeto
```

Acessar op diretório onde está o projeto
```
cd laravel-meu-projeto
```

Iniciar o projeto criado com Laravel
```
php artisan serve
```

Criar Controller
```
php artisan make:controller NomeDaController
```

Criar a View
```
php artisan make:view nomeDaView
```
```
php artisan make:view contas/create
```

Criar a migration
```
php artisan make:migration create_conta_tables
```

Executar a migration
```
php artisan migrate
```

Criar a model 
```
php artisan make:model Conta
```
Criar o arquivo Request com validações
```
php artisan make:request ContaRequest
```

Criar seed
```
php artisan make:seeder ContaSeeder 
```

Executar a seed
```
php artisan db:seed
```

Instalar o Vite
```
npm install
```

Instaalar o framework Bootstrap
```
npm i --save bootstrap @popperjs/core
```

Instalar o sass
```
npm i --save-dev sass
```

Executar as Bibliotecas do Node.js
```
npm run dev
```
Tradução para o português
https://github.com/lucascudo/laravel-pt-BR-localization

Biblioteca para gerar PDF
```
composer require barryvdh/laravel-dompdf
```

Instalar biblioteca sweetalert
```
npm install sweetalert2
```