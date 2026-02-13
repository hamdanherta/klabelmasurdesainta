<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ColorDataset;

class ColorDatasetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = base_path('dataset/dataset_final(5).csv');

        if (!file_exists($csvFile)) {
            $this->command->error("CSV file not found at: " . $csvFile);
            return;
        }

        $handle = fopen($csvFile, "r");
        if ($handle === FALSE) {
            $this->command->error("Failed to open CSV file.");
            return;
        }

        // Skip header
        fgetcsv($handle);

        $count = 0;
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $id = (int)$data[0];

            if ($id >= 5005 && $id <= 5014) {
                ColorDataset::create([
                    'id' => $id,
                    'jenis' => $data[2] ?? null,
                    'warna_dominan_1' => $data[3] ?? null,
                    'warna_dominan_2' => $data[4] ?? null,
                    'warna_dominan_3' => $data[5] ?? null,
                    'warna_dominan_4' => $data[6] ?? null,
                    'warna_dominan_5' => $data[7] ?? null,
                    'teori_warna' => $data[9] ?? null,
                    'warna_kombinasi' => $data[10] ?? null,
                ]);
                $count++;
            }
        }

        fclose($handle);
        $this->command->info("Seeded $count records (IDs 5005-5014).");
    }
}
