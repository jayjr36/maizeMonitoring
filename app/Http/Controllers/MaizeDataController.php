<?php

namespace App\Http\Controllers;

use App\Models\MaizeData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaizeDataController extends Controller
{
    public function receiveData(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'image' => 'required|string', 
            'height' => 'required|numeric',
            'thickness' => 'required|numeric',
            'color' => 'required|string',
            'defective' => 'required|boolean',
            'deficiency' => 'required|string',
        ]);

        // Decode the base64 image and save it
        $imageBase64 = $validatedData['image'];
        $imageName = $this->saveBase64Image($imageBase64);

        // Generate suggestion based on deficiency
        $suggestion = $this->generateSuggestion($validatedData['deficiency']);

        // Store the data
        $maizeData = MaizeData::create([
            'image' => $imageName, // Store the image file name or path
            'height' => $validatedData['height'],
            'thickness' => $validatedData['thickness'],
            'color' => $validatedData['color'],
            'defective' => $validatedData['defective'],
            'deficiency' => $validatedData['deficiency'],
            'suggestion' => $suggestion,
        ]);

        // Return a JSON response
        return response()->json([
            'message' => 'Data stored successfully!',
            'data' => $maizeData,
        ], 201);
    }

    /**
     * Save base64 image to storage.
     *
     * @param string $imageBase64
     * @return string
     */
    protected function saveBase64Image($imageBase64)
    {
        // Decode the base64 image
        $image = base64_decode($imageBase64);

        // Generate a unique filename
        $fileName = uniqid() . '.png'; // You can change the extension based on the image type

        // Define the path where the image will be stored
        $filePath = 'images/' . $fileName;

        // Store the image in the public disk (you can change the disk if necessary)
        Storage::disk('public')->put($filePath, $image);

        return $filePath;
    }

    /**
     * Generate suggestion based on deficiency.
     *
     * @param string $deficiency
     * @return string
     */
    protected function generateSuggestion($deficiency)
    {
        switch (strtolower($deficiency)) {
            case 'nitrogen':
                return 'Add fertilizer';
            case 'potassium':
                return 'Add wood ash, conduct soil test';
            case 'phosphorus':
                return 'Check soil pH';
            default:
                return 'No suggestion available';
        }
    }

    public function index()
    {
        $maizeData = MaizeData::latest()->get();
        return view('maize.index', compact('maizeData'));
    }

    public function fetchLatestData()
    {
        $maizeData = MaizeData::latest()->get();
        return response()->json($maizeData);
    }
}
