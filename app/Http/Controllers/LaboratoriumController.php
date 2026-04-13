<?php

namespace App\Http\Controllers;

use App\Models\Laboratorium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaboratoriumController extends Controller
{
    /**
     * Display a listing of all laboratorium resources
     */
    public function index()
    {
        $laboratoriums = Laboratorium::with('kepalLab', 'praktikums')->get();
        return response()->json([
            'success' => true,
            'data' => $laboratoriums
        ]);
    }

    /**
     * Show the form for creating a new laboratorium resource
     */
    public function create()
    {
        // Authorization: Only Admin can create
        if (Auth::user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Only admin can create laboratorium.'
            ], 403);
        }

        return response()->json([
            'message' => 'Show create form'
        ]);
    }

    /**
     * Store a newly created laboratorium in storage
     */
    public function store(Request $request)
    {
        // Authorization: Only Admin can create
        if (Auth::user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Only admin can create laboratorium.'
            ], 403);
        }

        $validated = $request->validate([
            'nama_laboratorium' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
            'kepala_lab' => 'required|integer|exists:users,id',
            'status' => 'required|in:Terpakai,Tersedia',
        ]);

        try {
            $laboratorium = Laboratorium::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Laboratorium created successfully',
                'data' => $laboratorium->load('kepalLab', 'praktikums')
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating laboratorium',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified laboratorium resource
     */
    public function show($id)
    {
        try {
            $laboratorium = Laboratorium::with('kepalLab', 'praktikums')->findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $laboratorium
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Laboratorium not found'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified laboratorium resource
     */
    public function edit($id)
    {
        // Authorization: Only Admin can edit
        if (Auth::user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Only admin can edit laboratorium.'
            ], 403);
        }

        try {
            $laboratorium = Laboratorium::findOrFail($id);
            return response()->json([
                'data' => $laboratorium
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Laboratorium not found'
            ], 404);
        }
    }

    /**
     * Update the specified laboratorium in storage
     */
    public function update(Request $request, $id)
    {
        // Authorization: Only Admin can update
        if (Auth::user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Only admin can update laboratorium.'
            ], 403);
        }

        try {
            $laboratorium = Laboratorium::findOrFail($id);

            $validated = $request->validate([
                'nama_laboratorium' => 'sometimes|string|max:255',
                'lokasi' => 'sometimes|string|max:255',
                'kapasitas' => 'sometimes|integer|min:1',
                'kepala_lab' => 'sometimes|integer|exists:users,id',
                'status' => 'sometimes|in:Terpakai,Tersedia',
            ]);

            $laboratorium->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Laboratorium updated successfully',
                'data' => $laboratorium->load('kepalLab', 'praktikums')
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Laboratorium not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating laboratorium',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified laboratorium from storage
     */
    public function destroy($id)
    {
        // Authorization: Only Admin can delete
        if (Auth::user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Only admin can delete laboratorium.'
            ], 403);
        }

        try {
            $laboratorium = Laboratorium::findOrFail($id);
            $laboratorium->delete();

            return response()->json([
                'success' => true,
                'message' => 'Laboratorium deleted successfully'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Laboratorium not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting laboratorium',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
