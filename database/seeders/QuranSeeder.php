<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class QuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('quran_data.json'));
        $data = json_decode($json, true)['quran'];

        foreach ($data as $ayah) {
            DB::table('quran')->insert([
                'chapter' => $ayah['chapter'],
                'verse' => $ayah['verse'],
                'text' => $ayah['text'],
                'char_count' =>  mb_strlen(preg_replace('/[\p{Mn}\s]/u', '', $ayah['text'])), // عدد الأحرف بدون مسافات
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
