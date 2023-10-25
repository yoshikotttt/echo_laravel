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
        $request->validate([
            'notification_id' => 'required|integer|exists:notifications,id',
            'age' => 'required|integer',
            'gender' => 'required|string',
            'chief_complaint' => 'required|string',
            'medical_history' => 'required|string',
            'vitals' => 'nullable|string',
        ]);

        try {
            $exam = new MedicalExam;
            $exam->notification_id = $request->notification_id;
            $exam->age = $request->age;
            $exam->gender = $request->gender;
            $exam->chief_complaint = $request->chief_complaint;
            $exam->medical_history = $request->medical_history;
            $exam->vitals = $request->vitals;
            $exam->save();

            return response()->json(['message' => 'Medical exam saved successfully!'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to save medical exam'], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show($notificationId)
    {
        $exam = MedicalExam::with('notification')->where('notification_id', $notificationId)->first();

        if (!$exam) {
            return response()->json(['message' => 'Exam not found'], 404);
        }

        return response()->json($exam);
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
       
    }

}
