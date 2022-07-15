<?php

namespace Database\Seeders;

use Faker\Core\Number;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class News extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert([
            'title' => Str::random(10),
            'image' => Str::random(10),
            'description' => Str::random(30),
            'author' => Str::random(10),
            'id_category' => Numberr::random(10)
        ])        
    }
}
