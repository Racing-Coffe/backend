<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Racing Coffe",
            "email" => "racingcoffe@gmail.com",
            "password" => '$2y$10$XhGGWeZEqP8QfwimVm9dteYBxM8ptQRqAFyTDjiq7MLfqwljlvkJ.', //Secret
            "avatar" => "avatar.jpg",
            "twitter" => "@RacingCoffe",
            "description" => "Conta Oficial do Racing Coffe",
            "is_author" => true
        ]);

        User::create([
            "name" => "Erick Bilhalba Abella",
            "email" => "erick@bilhalba.com.br",
            "password" => '$2y$10$CW2RNCirx6ClKsvINQnr7OgrcO/Zz41Jri52mN9e1cq40/RprXJwK', //MyPassword
            "avatar" => "avatar.jpg",
            "twitter" => "@TheDevick",
            "description" => "🚀 PHP é Bom Demais!\n🏁 Ocupado Aos Finais De Semana Vendo Corridas de Formula 1",
            "is_author" => true
        ]);

        User::create([
            "name" => "The Devick",
            "email" => "The@Devick.com",
            "password" => '$2y$10$3G01hoxRltTCxu9lmnASV.8a/f9fbQ/sQPoqoYNx.4jkQnEWwrFJS', //PHP
            "avatar" => "avatar.jpg"
        ]);

        User::create([
            "name" => "Simple User",
            "email" => "simple@user.com",
            "password" => '$2y$10$2sJBMDmDITzXrRbYzN3cYuJEgWFav1DoLHpxXMFA3rkRj7BJFActu' //123456
        ]);
    }
}
