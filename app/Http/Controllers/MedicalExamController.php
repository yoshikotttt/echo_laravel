<?php

namespace App\Http\Controllers;

use App\Models\MedicalExam;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MedicalExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'age' => 'required|integer',
            'gender' => 'required|string',
            'chief_complaint' => 'required|string',
            'medical_history' => 'required|string',
            'vitals' => 'nullable|string',
        ]);

        MedicalExam::create($data);
        return redirect()->back()->with('success', 'Medical exam data saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $medicalData = MedicalExam::findOrFail($id);

        $medicalData->delete();
    }

    public function showSkyway()
    {
        $skywayApiKey = config('services.skyway.api_key');
        $skywayId = auth()->user()->skyway_id;

        return Inertia::render('SkyWay', ['skywayApiKey' => $skywayApiKey, 'skywayId' => $skywayId]);
    }

}
