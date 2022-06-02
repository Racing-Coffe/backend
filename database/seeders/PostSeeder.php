<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            "title" => "Bem-Vindo ao Racing Coffe",
            "content" => "# Racing Coffe | O site criado para quem é amante de Fórmula 1.\n## O que é?\nO ***Racing Coffe*** é um site que foi criado para discutir diversos temas sobre **Fórmula 1**, de um jeito descontraído.\n\n## Como funciona?\nO site é dividido em [**Posts**](https://racingcoffe.vercel.app/posts), como um _Blog_. Cada post tem uma [**Tag**](https://racingcoffe.vercel.app/tags), onde você pode **filtrar** para ver posts de temas diversos, como posts sobre o resumo de corridas, notícias gerais da Fórmula 1, entre outros.\n\n## Redes Sociais\nEstamos presentes no [**Twitter**](https://twitter.com/RacingCoffe), onde você poderá ver a postagem de novos posts e algumas notícias sobre o projeto\n\n## O Criador\nMe Chamo [**Erick**](https://racingcoffe.vercel.app/authors/1), o criador desse projeto. Sou **programador** e claro, amante de Fórmula 1. Criei esse projeto principalmente para **treinar programação**, e juntei a minha habilidade como programador e amante da Fórmula 1 para **mostrar esse mundo da velocidade para mais pessoas**.\n\n## Como posso Ajudar?\nVocê pode ajudar **divulgando o site**, dando **sugestões** sobre o que você acha que poderia ser melhorado ou até mesmo através de **programação**.\n\n## O Site Código Aberto\nNosso site é **Código Aberto**, ou seja, o **código** dele pode ser visto por **qualquer um**. E caso você tenha o **conhecimento necessário**, você pode **contribuir** no nosso [**Github**](https://github.com/Racing-Coffe)\n",
            "author_id" => 1,
            "tag_id" => 1,
        ]);

        Post::create([
            "title" => "Sergio Pérez renova Seu Contrato!",
            "content" => "# Sergio Pérez na Red Bull até 2024\nO piloto mexicano **Sérgio Perez** teve seu contrato renovado até o ano de **2024**, competindo pela equipe **Red Bull**.\n\nDepois de uma fala do piloto mexicano após o **GP de Mônaco** - \"Eu assinei (O contrato) cedo demais\", os rumores começaram sobre uma possível renovação do Contrato em sua equipe. E apenas dois dias depois da Corrida, a Red Bull anunciou **Oficialmente** sua renovação de contrato.\n\nSérgio Perez corre pela Red Bull desde 2021, com 7 anos de experiência com outras equipes - Force India e Racing Point. Atualmente, Sergio Pérez se destaca principalmente pela sua **Defesa de Posição**, especialmente após a disputa no útlimo **GP de 2021 - Abu Dhabi**, onde segurou **Lewis Hamilton** durante várias voltas, recebendo assim o apelido de **\"Ministro de Defesa do México\"**\n\n---\n\n> \"Para nós, manter seu ritmo, habilidade de corrida e sua experiência foi uma decisão muito fácil, e estamos muito satisfeitos que Checo continuará correndo pela equipe até 2024. Em parceria com Max, acreditamos que temos uma dupla de pilotos que pode nos trazer os maiores prêmios na F1\"\n\nDisse **Christian Horner** (Chefe de Equipe da Red Bull) após a renovação.",
            "author_id" => 2,
            "tag_id" => 2
        ]);
    }
}
