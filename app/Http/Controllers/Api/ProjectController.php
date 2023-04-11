<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{
    public function index(Request $request): JsonResponse|string
    {
        try {
            $projects = Project::query()
                ->with('team')
                ->get();

            dd($projects);

            return response()->json([
                ProjectResource::collection($projects)
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
