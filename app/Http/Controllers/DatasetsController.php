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
            'filters' => Request::only(['search']),
        ]);
    }

    public function getDataset(string $dataset): JsonResponse
    {
        // get the available datasets
        $available_datasets = DB::table('available_datasets')->pluck('name')->toArray();

        // Ensure the dataset is available and exists in the database
        if (! in_array($dataset, $available_datasets) || ! Schema::hasTable($dataset)) {
            return response()->json([
                'message' => 'Dataset not found',
            ], 404);
        }

        // Return the headers and rows
        $headers = Schema::getColumnListing($dataset);
        $rows = DB::table($dataset)->get();

        return response()->json([
            'headers' => $headers,
            'rows' => $rows,
        ]);
    }

    public function getAvailableDatasets(): JsonResponse
    {
        // get the array of available datasets from the available_datasets table
        $available_datasets = DB::table('available_datasets')->pluck('name')->toArray();

        // Ensure there are available datasets before responding
        if (empty($available_datasets)) {
            return response()->json([
                'message' => 'No datasets found',
            ], 404);
        }

        // Otherwise return the available datasets
        return response()->json([
            'datasets' => $available_datasets,
        ]);
    }
}
