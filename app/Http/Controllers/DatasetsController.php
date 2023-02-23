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
}
