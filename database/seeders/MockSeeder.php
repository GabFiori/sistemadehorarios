<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Professor;
use App\Models\Sala;
use App\Models\Uc;
use App\Models\Turma;

class MockSeeder extends Seeder
{
    public function run(): void
    {
        Turma::create(['nome' => 'E2-2023 Mista', 'representante' => 'Giovanna Kubo']);
        Turma::create(['nome' => 'E3-2023 Mista', 'representante' => 'Marcelly Liechocki']);
        Turma::create(['nome' => ' E1-2023 Mista', 'representante' => 'Luigi Castoldi Picch']);
        Professor::create(['nome' => 'Eron Ponce Pereira', 'matricula' => '232072001', 'email' => 'eron.ponce@unifil.br']);
        Professor::create(['nome' => 'Robson de Lacerda Zambroti', 'matricula' => '232072002', 'email' => 'robson.lacerda@unifil.br']);
        Professor::create(['nome' => 'Ricardo Petri Silva', 'matricula' => '232072003', 'email' => 'ricardo.petri@unifil.br']);
        Professor::create(['nome' => 'Bruno Henrique Coleto', 'matricula' => '232072004', 'email' => 'bruno.coleto@unifil.br']);
        Professor::create(['nome' => 'Wilson Sanches', 'matricula' => '232072005', 'email' => 'wilson.sanches@unifil.br']);
        Professor::create(['nome' => 'Luiz Nunes', 'matricula' => '232072006', 'email' => 'luiz.nunes@unifil.br']);
        Professor::create(['nome' => 'Marcelo Yukio Yamamoto', 'matricula' => '232072007', 'email' => 'marcelo.yamamoto@unifil.br']);
        Professor::create(['nome' => 'Gustavo Queiroz ', 'matricula' => '232072008', 'email' => 'gustavo.queiroz@unifil.br']);
        Professor::create(['nome' => 'Edson Kaneshima', 'matricula' => '232072009', 'email' => 'edson.kaneshima@unifil.br']);
        Professor::create(['nome' => 'João Vitor da Costa Andrade', 'matricula' => '232082001', 'email' => 'joao.andrade@unifil.br']);
        Professor::create(['nome' => 'Mário Henrique A. Adaniya', 'matricula' => '232082002', 'email' => 'mario.henrique@unifil.br']);
        Sala::create(['nome' => 'Lab 2', 'campus' => 'Centro', 'capacidade' => 25]);
        Sala::create(['nome' => 'Lab 3', 'campus' => 'Centro', 'capacidade' => 25]);
        Sala::create(['nome' => 'Lab 4', 'campus' => 'Centro', 'capacidade' => 30]);
        Sala::create(['nome' => 'Lab 5', 'campus' => 'Centro', 'capacidade' => 30]);
        Sala::create(['nome' => 'Lab 6', 'campus' => 'Centro', 'capacidade' => 40]);
        Sala::create(['nome' => 'Lab 7', 'campus' => 'Centro', 'capacidade' => 40]);
        Sala::create(['nome' => 'Lab 8', 'campus' => 'Centro', 'capacidade' => 40]);
        Sala::create(['nome' => '1030', 'campus' => 'Ipolon II', 'capacidade' => 20]);
        Sala::create(['nome' => '1031', 'campus' => 'Ipolon II', 'capacidade' => 30]);
        Sala::create(['nome' => '1032', 'campus' => 'Ipolon II', 'capacidade' => 50]);
        Uc::create(['nome' => 'Cálculo Diferencial e Integral: Derivada,Integral e Aplicações I', 'grupo' => '815', 'codigo' => 'MATE230024']);
        Uc::create(['nome' => 'Interação Humano Computador: Desenvolvimento de Design de Interação', 'grupo' => '1019', 'codigo' => 'EGSW230036']);
        Uc::create(['nome' => 'Desenvolvimento com DevOps: Gerenciamento de containers', 'grupo' => '805', 'codigo' => 'INRC230011']);
        Uc::create(['nome' => 'Projeto e Desenvolvimento de Sistema I: Projeto', 'grupo' => '567', 'codigo' => 'ALLP220010']);
        Uc::create(['nome' => 'Projeto Interdisciplinar V: PI X', 'grupo' => '1877', 'codigo' => 'PRIN220007']);
        Uc::create(['nome' => 'Estatística: Inferência Estatística', 'grupo' => '690', 'codigo' => 'ESDS230004']);
        Uc::create(['nome' => 'Redes de Computadores: Camada de Transporte', 'grupo' => '804', 'codigo' => 'INRC230004']);
        Uc::create(['nome' => 'Compiladores: Estrutura de um Compilador', 'grupo' => '1162', 'codigo' => 'FCOM230003']);
        Uc::create(['nome' => 'Redes de Computadores: Endereçamento IP', 'grupo' => '803', 'codigo' => 'INRC230003']);
        Uc::create(['nome' => 'Projeto Interdisciplinar VI: PI XI', 'grupo' => '1283', 'codigo' => 'PRIN220008']);
        Uc::create(['nome' => 'Projeto e Desenvolvimento de Sistema II: Desenvolvimento', 'grupo' => '881', 'codigo' => 'ALLP220011']);
        Uc::create(['nome' => 'Cálculo numérico: Métodos Numéricos Computacionais', 'grupo' => '1229', 'codigo' => 'MAPC230004']);
        Uc::create(['nome' => 'Inteligência Artificial: Aplicações de Aprendizado de Máquinas', 'grupo' => '1218', 'codigo' => 'INAR230008']);
        Uc::create(['nome' => 'Metodologia de Pesquisa: Desenvolvimento do Artigo Científico', 'grupo' => '777', 'codigo' => 'FUNH230043']);
        Uc::create(['nome' => 'Estatística: Probabilidades e Introdução a Inferência Estatística', 'grupo' => '689', 'codigo' => 'ESDS230003']);
        Uc::create(['nome' => 'Projeto e Desenvolvimento de Sistema I: Análise', 'grupo' => '566', 'codigo' => 'ALLP220009']);
        Uc::create(['nome' => 'Desenvolvimento Web: Desenvolvimento Web com MVC', 'grupo' => '613', 'codigo' => 'COAP230029']);
        Uc::create(['nome' => 'Processo e Desenvolvimento de Software: Introdução ao Processo de Desenvolvimento de Software', 'grupo' => '670', 'codigo' => 'EGSW230032']);
        Uc::create(['nome' => 'Sistemas Digitais: Circuitos Digitais coma Lógica Sequencial', 'grupo' => '750', 'codigo' => 'FCOM230002']);
        Uc::create(['nome' => 'Banco de Dados Avançado: SQL avançado', 'grupo' => '579', 'codigo' => 'BDAD230007']);
        Uc::create(['nome' => 'Paradigmas de Linguagens de Programação: Introdução a Paradigmas de Linguagem de Programação', 'grupo' => '570', 'codigo' => 'ALLP230005']);
        Uc::create(['nome' => 'Análise e Projetos Orientado a Objetos: Modelando um software com UML', 'grupo' => '665', 'codigo' => 'EGSW230005']);
    }
}
