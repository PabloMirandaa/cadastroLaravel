<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>   
        
    </head>
    <body>

        <a href="{{route('conta.create')}}">Cadastrar</a><br>
        <a href="{{route('conta.show')}}">Detalhe das Contas</a><br>
        <a href="{{route('conta.edit')}}">Editar</a>
        <h1>bem vindo</h1>
        <a href="{{route('conta.index')}}">Listar as Contas</a>
        
    </body>
</html>
