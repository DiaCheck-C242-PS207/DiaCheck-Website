<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Predictions;

class PredictionsController extends Controller
{
    public function index()
    {
        return view('pages.predictions', [
            'title' => 'Predictions - DiaCheck',
            'active' => 'predictions',
        ]);
    }

    public function predictions(Request $request)
    {
        // Validasi input dari user
        $validatedData = $request->validate([
            'gender' => 'required|numeric',
            'age' => 'required|numeric',
            'hypertension' => 'required|numeric',
            'heart_disease' => 'required|numeric',
            'bmi' => 'required|numeric',
            'HbA1c_level' => 'required|numeric',
            'blood_glucose_level' => 'required|numeric',
        ]);

        // Kirim data ke API Flask
        $response = Http::post('http://127.0.0.1:8080/predictions', [
            'gender' => $validatedData['gender'],
            'age' => $validatedData['age'],
            'hypertension' => $validatedData['hypertension'],
            'heart_disease' => $validatedData['heart_disease'],
            'bmi' => $validatedData['bmi'],
            'HbA1c_level' => $validatedData['HbA1c_level'],
            'blood_glucose_level' => $validatedData['blood_glucose_level'],
        ]);

        if ($response->successful()) {
            // Ambil hasil prediksi dari API Flask
            $predictionData = $response->json()['data'];

            // Simpan data ke dalam database
            Predictions::create([
                'user_id' => Auth::user()->id,
                'gender' => $validatedData['gender'],
                'age' => $validatedData['age'],
                'hypertension' => $validatedData['hypertension'],
                'heart_disease' => $validatedData['heart_disease'],
                'bmi' => $validatedData['bmi'],
                'HbA1c_level' => $validatedData['HbA1c_level'],
                'blood_glucose_level' => $validatedData['blood_glucose_level'],
                'prediction' => $predictionData['prediction'] == 1 ? 'Diabetes' : 'No Diabetes',
                'probability' => $predictionData['probability'],
                'message' => $predictionData['message'],
            ]);            

            // Kirim hasil prediksi ke view result.blade.php
            return view('pages.result', [
                'prediction' => $predictionData,
                'probability' => json_encode($predictionData['probabilities']),
                'message' => $predictionData['message'],
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to get prediction from Flask API',
            'data' => null
        ], 500);
    }
}