
@extends('layouts.admin')

@section('content')
    <div class = "card mt-4 mb-4 border-light shadow">
        <div class = "card-header d-flex justify-content-between">
            <span>Cadastrar Conta</span>
            <span>
                <a href="{{route('conta.index')}}"
                    class="btn btn-info btn-sm">Listar</a>
                
            </span>
        </div>

        {{-- Verificar se existe a sessão success e imprimir o valor --}}
        <x-alert/>

        @if($errors->any())
            <div class= "alert alert-danger m-3" role="alert">
                @foreach ($errors->all() as $error)
                    {{$error}}<br>
                @endforeach            
            </div>
        @endif
        <div class = "card-body">
           
            <form action="{{ route('conta.store') }}" method="POST" class="row g-3">
               @csrf <!--utilizado para indicar que essa requisição esta vindo de uma página interna da aplicação-->
                <div class="col-md-12 col-sm-12">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name='nome' class="form-control" id="nome" placeholder="Nome da Conta" value="{{old('nome')}}" required>
                </div>
               
                <div class="col-md-4 col-sm-12">
                    <label for="valor" class="form-label">Valor</label>
                    <input type="text" name='valor' class="form-control" id="valor" placeholder="Valor da Conta" value="{{old('valor')}}" required>
                </div>
               
                <div class="col-md-4 col-sm-12">
                    <label for="vencimento" class="form-label">Vencimento</label>
                    <input type="date" name='vencimento' class="form-control" id="vencimento" value="{{old('vencimento')}}" required>
                </div>
                
                <div class="col-md-4 col-sm-12">
                    <label for="situacao_conta_id" class="form-label">Status</label>
                    <select name="situacao_conta_id" id="situacao_conta_id" class="form-select">
                        <option value="">Selecione</option>
                        @forelse ($situacoesContas as $situacaoConta)
                            <option value="{{$situacaoConta->id}}" {{old('situacao_conta_id')== $situacaoConta->id ? 'selected' : ''}}>{{$situacaoConta->nome}}</option>
                        @empty
                            <option value="">Nenhuma Situação da conta encontrada</option>

                        @endforelse                
                    </select>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                </div>
                
            </form>
    </div> 
@endsection   
