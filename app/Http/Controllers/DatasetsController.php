<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Schema;
use Inertia\Inertia;
use Inertia\Response;

class DatasetsController extends Controller
{
  public function index(): Response
  {
    $datasets = Dataset::query()
      ->when(Request::input('search'), function ($query, $search) {
        $query->where('description', 'like', "%{$search}%")
          ->orWhere('data_url', 'like', "%{$search}%")
          ->orWhere('component', 'like', "%{$search}%");
      })
      ->orderBy('end_year', 'desc')
      ->paginate()
      ->onEachSide(1)
      ->withQueryString();

    return Inertia::render('Datasets/Index', [
      'datasets' => $datasets,
      'filters' => Request::only(['search'])
    ]);
  }

  public function getDataset(string $dataset) : JsonResponse
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
    ];

    // Ensure the dataset is available and exists in the database
    if (!in_array($dataset, $available_datasets) || !Schema::hasTable($dataset)) {
      return response()->json([
        'message' => 'Dataset not found'
      ], 404);
    }

    // Return the headers and rows
    $headers = Schema::getColumnListing($dataset);
    $rows = DB::table($dataset)->get();
    return response()->json([
      'headers' => $headers,
      'rows' => $rows
    ]);
  }
}
