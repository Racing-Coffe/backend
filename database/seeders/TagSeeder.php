<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            "title" => "Racing Coffe",
            "description" => "Novidades sobre o Racing Coffe"
        ]);
        
        Tag::create([
            "title" => "Contratos",
            "description" => "As últimas notícias sobre os Contratos da Fórmula 1"
        ]);
    }
}
