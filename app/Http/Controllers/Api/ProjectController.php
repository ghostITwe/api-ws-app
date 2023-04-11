<?php

namespace App\Http\Controllers\Api;

use App\Filters\{CreatedFilter, SearchFilter};
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\{JsonResponse, Request, Resources\Json\AnonymousResourceCollection};

class ProjectController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection|string
    {
        try {
            return ProjectResource::collection(Project::query()
                ->with('team')
                ->filtered($request, [
                    SearchFilter::class,
                    CreatedFilter::class
                ])
                ->get());
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(Request $request): ProjectResource|string
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|unique:projects',
                'deadline' => 'required|string',
                'description' => 'required|string',
                'objective' => 'required|string',
                'problem' => 'required|string',
                'type' => 'required',
                'actual' => 'required|string',
                'target_audience' => 'required|string',
                'competitors' => 'required|string',
                'novelty' => 'required|string',
                'risks' => 'required|string',
                'product_type' => 'required',
                'product_result' => 'required',
                'main_characteristics_product' => 'required|string',
                'resources' => 'required|string',
                'income' => 'required|string',
                'promotion_channels' => 'required',
                'partners' => 'required|string',
                'achieved_level' => 'required',
                'implementation_phase' => 'required',
            ]);

            $project = Project::create($data);

            return ProjectResource::make($project);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function update($id, Request $request): string|ProjectResource
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|unique:projects',
                'deadline' => 'some|string',
                'description' => 'some|string',
                'objective' => 'some|string',
                'problem' => 'some|string',
                'type' => 'some',
                'actual' => 'some|string',
                'target_audience' => 'some|string',
                'competitors' => 'some|string',
                'novelty' => 'some|string',
                'risks' => 'some|string',
                'product_type' => 'some',
                'product_result' => 'some',
                'main_characteristics_product' => 'some|string',
                'resources' => 'some|string',
                'income' => 'some|string',
                'promotion_channels' => 'some',
                'partners' => 'some|string',
                'achieved_level' => 'some',
                'implementation_phase' => 'some',
            ]);

            $project = Project::query()->with('team')->findOrFail($id);

            $project->update($data);

            return ProjectResource::make($project);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function destroy($id): JsonResponse|string
    {
        try {
            $project = Project::query()->with('team')->findOrFail($id);

            $project->delete();

            return response()->json([
                'message' => 'Project deleted'
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
