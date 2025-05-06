<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class category_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = database_path('\storage\app\private\CategoriesFInalProj.csv');

        // Open the CSV file
        if (($handle = fopen($csvFile, 'r')) !== false) {
            // Skip the header row
            fgetcsv($handle);

            // Loop through each row in the CSV
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                // Extract the category name from the CSV row
                $categoryName = $data[0];

                // Make a POST request to the /categories endpoint
                Http::post('http://localhost/api/categories', [
                    'name' => $categoryName,
                ]);
            }

            // Close the file
            fclose($handle);
        }
    }
}
