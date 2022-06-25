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
            "password" => "Secret",
            "avatar" => "avatar.jpg",
            "twitter" => "@RacingCoffe",
            "description" => "Conta Oficial do Racing Coffe",
            "is_author" => true
        ]);

        User::create([
            "name" => "Erick Bilhalba Abella",
            "email" => "erick@bilhalba.com.br",
            "password" => "MyPassword",
            "avatar" => "avatar.jpg",
            "twitter" => "@TheDevick",
            "description" => "🚀 PHP é Bom Demais!\n🏁 Ocupado Aos Finais De Semana Vendo Corridas de Formula 1",
            "is_author" => true
        ]);

        User::create([
            "name" => "The Devick",
            "email" => "The@Devick.com",
            "password" => "PHP",
            "avatar" => "avatar.jpg"
        ]);

        User::create([
            "name" => "Simple User",
            "email" => "simple@user.com",
            "password" => "123456"
        ]);
    }
}
