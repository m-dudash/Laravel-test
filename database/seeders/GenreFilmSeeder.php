<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreFilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('table_genre_film')->insert([
            ['genre_id' => 1, 'film_id' => 1],
            ['genre_id' => 5, 'film_id' => 1],
            ['genre_id' => 5, 'film_id' => 2],
            ['genre_id' => 3, 'film_id' => 3],
        ]);
    }
}
