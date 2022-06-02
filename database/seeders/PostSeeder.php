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
            "title" => "Ferrari VS Red Bull: A Luta de F1",
            "content" => "# Vamos discutir um pouco sobre a luta Ferrari VS RedBull?\nA luta entre as duas equipes, principalmente com Charles Leclerc (Ferrari) e Max Verstappen (Red Bull) está intensa.\nCom a frequente falha de motor da Red Bull, Max Verstappen não parece muito confiante com o carro.",
            "author_id" => 1,
            "tag_id" => 1
        ]);
        
        Post::create([
            "title" => "Mercedes ainta tem chances de ganhar o campeonato?",
            "content" => "# A Mercedes iniciou muito mal sua temporada 2022, diferentemente de sua antiga adversária: Red Bull?\nO carro da equipe das Flechas de Prata está em uma fase difícil, onde em um final de semana consegue pódios e outro está batalhando contra Haas. Realmente, um cenário que não estamos acostumados a ver esses últimos anos.",
            "author_id" => 2,
            "tag_id" => 2
        ]);
        
        Post::create([
            "title" => "Memes da F1!",
            "content" => "# A Fórmula 1 Está Repleta de Memes, Não é Mesmo??\nEntão aqui veremos alguns memes deste campeonato frenético de 2022, começando pelo patrão se preparando para andar de trator: ![Hamilton](https://pbs.twimg.com/media/FRHFKovWQAE2qc7?format=jpg&name=medium)",
            "author_id" => 2,
            "tag_id" => null
        ]);
    }
}
