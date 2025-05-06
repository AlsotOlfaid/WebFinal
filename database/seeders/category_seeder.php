<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class category_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = storage_path('app/CategoriesFinalProj.csv');

        $file = fopen($path, 'r');

        // Lee la cabecera
        $headers = fgetcsv($file);

        while (($row = fgetcsv($file)) !== false) {
            $data = array_combine($headers, $row);

            DB::table('categories')->insert([
                'name' => $data['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        fclose($file);
    }
}
