<?php

namespace Database\Seeders;

use App\Models\Comment;
use COM;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::create([
            "content" => "Não esqueça de dar o like no Post!",
            "user_id" => 1,
            "post_id" => 1,
            "is_fixed" => true
        ]);

        Comment::create([
            "content" => "É tão bom ser um escritor aqui!",
            "user_id" => 2,
            "post_id" => 1
        ]);

        Comment::create([
            "content" => "Acho que encontrei o meu blog preferido 👀",
            "user_id" => 3,
            "post_id" => 1
        ]);

        Comment::create([
            "content" => "É uma boa notícia ver essa renovação de contrato do Sérgio Perez. Uma pena para Gasly 😕",
            "user_id" => 2,
            "post_id" => 2
        ]);
    }
}
