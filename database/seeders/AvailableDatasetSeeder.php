<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AvailableDatasetSeeder extends Seeder
{
  /**
   * Populate the Available Datasets with the curated datasets.
   */
  public function run(): void
  {
    $available_datasets = [
      "P_CBC",
      "CBC_J",
      "CBC_I",
      "CBC_H",
      "CBC_G",
      "CBC_F",
      "CBC_E",
      "CBC_D",
      "HIV_E",
      "HIV_G",
      "HIV_H",
      "HIV_F",
      "HIV_J",
      "HIV_D",
      "HIV_I",
      "L03_C",
      "L03_B",
      "LAB03",
      "MCQ_E",
      "MCQ",
      "MCQ_D",
      "MCQ_C",
      "MCQ_B",
      "MCQ_F",
      "MCQ_G",
      "MCQ_H",
      "MCQ_I",
      "MCQ_J",
      "P_MCQ",
      "P_SMQ",
      "SMQ_J",
      "SMQ_I",
      "SMQ_H",
      "SMQ_G",
      "SMQ_F",
      "SMQ_E",
      "SMQ_D",
      "SMQ_C",
      "SMQ_B",
      "P_SMQ",
      "SMQ",
      "SMQ_CBC",
    ];

    // Populate the database with the curated datasets if they don't already exist
    foreach ($available_datasets as $dataset) {
      if (DB::table('available_datasets')->where('name', $dataset)->exists()) {
        continue;
      }

      DB::table('available_datasets')->insert([
        'name' => $dataset,
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }
  }
}
