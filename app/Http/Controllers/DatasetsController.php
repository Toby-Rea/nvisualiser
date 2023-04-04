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
}
