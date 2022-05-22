<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::create([
            "name" => "Erick Bilhalba Abella",
            "email" => "erick@bilhalba.com.br",
            "password" => "MyPassword",
            "avatar" => "avatar.jpg",
            "twitter" => "@TheDevick",
            "description" => "🚀 PHP é Bom Demais!\n🏁 Ocupado Aos Finais De Semana Vendo Corridas de Formula 1"
        ]);
        
        Author::create([
            "name" => "Serjão",
            "email" => "serjao@botecof1.com.br",
            "password" => "MyPassword",
            "twitter" => "@SergioSiverly",
            "description" => "Um menino que ficava com um prato na frente da TV fingindo ser um piloto de F1 nos anos 1990 e criador de conteúdo no @canalBOTECOF1"
            
        ]);
        
        Author::create([
            "name" => "Estagiário",
            "email" => "estagiario@f1.com.br",
            "password" => "MyPassword",
        ]);
    }
}
