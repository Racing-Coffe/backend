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
            "name" => "Racing Coffe",
            "email" => "racingcoffe@gmail.com",
            "password" => "Secret",
            "avatar" => "avatar.jpg",
            "twitter" => "@RacingCoffe",
            "description" => "Conta Oficial do Racing Coffe"
        ]);

        Author::create([
            "name" => "Erick Bilhalba Abella",
            "email" => "erick@bilhalba.com.br",
            "password" => "MyPassword",
            "avatar" => "avatar.jpg",
            "twitter" => "@TheDevick",
            "description" => "🚀 PHP é Bom Demais!\n🏁 Ocupado Aos Finais De Semana Vendo Corridas de Formula 1"
        ]);
    }
}
