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
            "title" => "Red Bull - Ferrari",
            "description" => "Red Bull VS Ferrari"
        ]);
        
        Tag::create([
            "title" => "Mercedes"
        ]);
    }
}
