<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use Inertia\Inertia;
use Inertia\Response;

class DatasetsController extends Controller
{
  public function index(): Response
  {
    return Inertia::render('Datasets/Index', [
      'datasets' => Dataset::all(),
    ]);
  }

  public function download(string $id)
  {
    $dataset = Dataset::where('id', $id)->firstOrFail();

    // Infer the output path from the URL
    $split_url = explode("/", $dataset->data_url);
    $file_name = end($split_url);
    $path = storage_path('app/datasets/') . $file_name;

    // Ensure file isn't already downloaded
    if (file_exists($path)) {
      return $file_name . " already downloaded";
    }

    // Download the file from the URL and store
    $data = file_get_contents($dataset->data_url);
    file_put_contents($path, $data);

    return $file_name . " downloaded successfully";
  }
}
