<?php

namespace Database\Seeders;

use App\Models\Conta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!Conta::where('nome', 'Energia')->first()){
            Conta::create([
                'nome'=>'Energia',
                'valor'=>'147.34',
                'vencimento'=>'2024-02-03',
            ]);
        }
        if(!Conta::where('nome', 'Internet')->first()){
            Conta::create([
                'nome'=>'Internet',
                'valor'=>'187.34',
                'vencimento'=>'2024-02-03',
            ]);
        }
        if(!Conta::where('nome', 'Gás')->first()){
            Conta::create([
                'nome'=>'Internet',
                'valor'=>'287.34',
                'vencimento'=>'2024-03-27',
            ]);
        }
         
    }
}
