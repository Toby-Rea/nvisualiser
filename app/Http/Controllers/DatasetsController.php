<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;

class DatasetsController extends Controller
{
  public function index(): Response
  {
    $datasets = Dataset::query()
      ->when(Request::input('search'), function ($query, $search) {
        $query->where('description', 'like', "%{$search}%")->orWhere('data_url', 'like', "%{$search}%");
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

//  public function download(string $id)
//  {
//    $dataset = Dataset::where('id', $id)->firstOrFail();
//
//    // Infer the output path from the URL
//    $split_url = explode("/", $dataset->data_url);
//    $file_name = end($split_url);
//    $path = storage_path('app/datasets/') . $file_name;
//
//    // Ensure file isn't already downloaded
//    if (file_exists($path)) {
//      return response($file_name . " already downloaded");
//    }
//
//    // Download the file from the URL and store
//    $data = file_get_contents($dataset->data_url);
//    file_put_contents($path, $data);
//
//    // Convert to CSV
//    Process::run("python3 " . storage_path("app/convert.py") . " " . $path);
//
//    // update table
//    $dataset->downloaded = true;
//    $dataset->save();
//
//    return response($file_name . " downloaded successfully");
//  }
}
