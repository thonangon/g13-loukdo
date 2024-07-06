<?php

namespace App\Http\Controllers\Plans;

use App\Http\Controllers\Controller;
use App\Models\Plans;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    
    public function index()
    {
        $plans = Plans::all();
        return response()->json(['plans' => $plans]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
        ]);

        $plans = Plans::store($request);

        return response()->json(['plan' => $plans], 201);
    }

    public function show($id)
    {
        $plan = Plans::findOrFail($id);
        return response()->json(['plan' => $plan]);
    }

    public function update(Request $request, $id)
    {
        $plan = Plans::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
        ]);
        $plan->update($request->all());

        return response()->json(['plan' => $plan], 200);
    }

    public function destroy($id)
    {
        $plan = Plans::findOrFail($id);
        $plan->delete();
        return response()->json(['message' => 'Plan deleted successfully']);
    }

}