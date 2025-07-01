<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = [
            ['title' => 'Game of Thrones', 'status' => true, 'poster' => 'default.jpg'],
            ['title' => 'Attack on Titan', 'status' => false, 'poster' => 'default.jpg'],
            ['title' => 'Interstellar', 'status' => true, 'poster' => 'default.jpg'],
        ];

        foreach ($movies as $movie) {
            DB::table('films')->insert([
                'title' => $movie['title'],
                'status' => $movie['status'],
                'poster' => $movie['poster'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
