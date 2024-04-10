<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContaRequest;
use App\Models\Conta;
use App\Models\SituacaoConta;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContaController extends Controller
{
    //Listar as contas
    public function index(Request $request)//função de carregar a view listar
    {
        
        // Recuperar os registros dp BD
        // $contas=Conta::orderByDesc('created_at')->get(); Método com o get para recuperar os registros
        $contas = Conta::when($request->has('nome'), function($whenQuery) use ($request){
            $whenQuery->where('nome', 'like', '%' . $request->nome . '%'); //o "%" indica que pode ter valor antes e depois 
        })
        // when é usando para condições dinamicas da consulta
        ->when($request->filled('data_inicio'), function($whenQuery) use ($request){
            $whenQuery->where('vencimento', '>=', \Carbon\Carbon::parse($request->data_inicio)->format('Y-m-d'));
        }) 
        ->when($request->filled('data_fim'), function($whenQuery) use ($request){
            $whenQuery->where('vencimento', '<=', \Carbon\Carbon::parse($request->data_fim)->format('Y-m-d'));
        }) 
        ->with('situacaoConta')
        ->orderByDesc('created_at')
        ->paginate(4)
        ->withQueryString();

        // dd($contas);

        //Carregar uma view
        return view('conta.index',[
            'contas'=>$contas,
            'nome'=>$request->nome, 
            'data_inicio'=>$request->data_inicio, 
            'data_fim'=>$request->data_fim,
        ]); // comando para criar a view: php artisan make:view contas/index
    }
    //Carregar o formulario de cadastrar nova conta
    public function create()
    {
        // Recuperar do BD as situações
        $situacoesContas=SituacaoConta::orderBy('nome','asc')->get();
        
        return view('conta.create', [
            'situacoesContas'=> $situacoesContas
        ]); 
    }
    
    // cadastrar no banco de dados nova conta
    public function store(ContaRequest $request) //importo o "ContaRequest" depois atribuo e injeto em "$request"
    {
        // Validar o formulário
        $request->validated();
        
        // Cadastrar no BD na tabela crusos os valores de todos os campos
        $conta = Conta::create([
            'nome' => $request->nome,
            'valor' => str_replace(',', '.', str_replace('.', '', $request->valor)),
            'vencimento' => $request->vencimento,
            'situacao_conta_id' => $request->situacao_conta_id,
        ]); 
        
        // Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route("conta.show",['conta'=> $conta->id])->with('success','Conta cadastrada com sucesso');
    }
    // Detalhes da conta
    public function show(Conta $conta)
    {
      
        // Carrega a view
        return view('conta.show',['conta'=>$conta]);
    }
    // carregar o formulário editar a conta
    public function edit(Conta $conta)
    {
        // Recuperar do BD as situações
        $situacoesContas=SituacaoConta::orderBy('nome','asc')->get();
   
        return view('conta.edit', [
            'conta'=>$conta,
            'situacoesContas' => $situacoesContas,
        ]); 
    }
    // editar no banco de dados a conta
    public function update(ContaRequest $request, Conta $conta)
    {
        // Validar o Form
        $request->validated();
        try{
        // Editar as informações do registro no BD
        $conta->update([
            'nome'=> $request->nome,
            'valor'=> str_replace(',', '.', str_replace('.', '', $request->valor)),
            'vencimento'=> $request->vencimento,
            'situacao_conta_id' => $request->situacao_conta_id,
        ]);  

        // Salvar log
        Log::info('Conta editada com sucesso',['id'=>$conta->id]);

        // Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route("conta.show",['conta'=> $conta->id])->with('success','Conta editada com sucesso');
        }catch(Exception $e){

            // salvar log
            Log::warning('Conta não editada',['error'=>$e->getMessage()]);
            // Redirecionar o usuario, enviar a mensagem de erro
            return back()->withInput()->with('error','conta não editada!');
        }
    }    
    // excluir a conta do banco de dados
    public function destroy(Conta $conta)
    {      
        // Excluir o registro do BD
        $conta->delete();

        // Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route("conta.index",['conta'=> $conta->id])->with('success','Conta apagada com sucesso');

    }

    public function gerarPdf(Request $request)
    {
        // Recuperar os registros do BD
        // $contas=Conta::orderByDesc('created_at')->get();
        $contas = Conta::when($request->has('nome'), function($whenQuery) use ($request){
            $whenQuery->where('nome', 'like', '%' . $request->nome . '%'); //o "%" indica que pode ter valor antes e depois 
        })
        // when é usando para condições dinamicas da consulta
        ->when($request->filled('data_inicio'), function($whenQuery) use ($request){
            $whenQuery->where('vencimento', '>=', \Carbon\Carbon::parse($request->data_inicio)->format('Y-m-d'));
        }) 
        ->when($request->filled('data_fim'), function($whenQuery) use ($request){
            $whenQuery->where('vencimento', '<=', \Carbon\Carbon::parse($request->data_fim)->format('Y-m-d'));
        }) 
        ->orderByDesc('created_at')
        ->get();

        // calcular a soma total dos valores
        $totalValor =$contas->sum('valor');
     
        // Carregar a string com HTML/conteúdo e determinar a orientação e o tamanho do arquivo
        $pdf=PDF::loadView('conta.gerar-pdf', [
            'contas'=>$contas,
            'totalValor'=>$totalValor
            ])->setPaper('a4', 'portrait');

        return $pdf->stream('listar_contas.pdf');
    }

    
}
