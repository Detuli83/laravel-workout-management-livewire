<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkoutRequest;
use App\Http\Requests\UpdateWorkoutRequest;
use App\Http\Resources\WorkoutResource;
use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Workout::where('user_id', $request->user()->id);

        // Filter by is_active
        if ($request->has('is_active')) {
            $query->where('is_active', $request->boolean('is_active'));
        }

        // Sort by date
        if ($request->has('sort') && $request->get('sort') === 'date') {
            $query->orderBy('date');
        } else {
            $query->latest();
        }

        $workouts = $query->get();
        return WorkoutResource::collection($workouts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkoutRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $workout = Workout::create($data);
        return response()->json([
            'message' => 'Workout created successfully.',
            'data' => new WorkoutResource($workout),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Workout $workout)
    {
        $this->authorizeWorkout($workout);
        return new WorkoutResource($workout);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkoutRequest $request, Workout $workout)
    {
        $this->authorizeWorkout($workout);
        $workout->update($request->validated());
        return response()->json([
            'message' => 'Workout updated successfully.',
            'data' => new WorkoutResource($workout),
        ]);
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy(Workout $workout)
    {
        $this->authorizeWorkout($workout);
        $workout->delete();
        return response()->json([
            'message' => 'Workout deleted successfully.'
        ]);
    }

    /**
     * Ensure the workout belongs to the authenticated user.
     */
    protected function authorizeWorkout(Workout $workout)
    {
        if ($workout->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
