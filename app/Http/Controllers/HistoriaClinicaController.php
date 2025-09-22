<?php

namespace App\Http\Controllers;

use App\Models\HistoriaClinica;
use Illuminate\Http\Request;

class HistoriaClinicaController extends Controller
{
    public function index()
    {
        return HistoriaClinica::with('fichaMedica')->get();
    }

    public function store(Request $request)
    {
        $historia = HistoriaClinica::create($request->only(['ficha_medica_id','antecedentes','tratamiento']));
        return response()->json($historia, 201);
    }

    public function show(HistoriaClinica $historiaClinica)
    {
        return $historiaClinica->load('fichaMedica');
    }

    public function update(Request $request, HistoriaClinica $historiaClinica)
    {
        $historiaClinica->update($request->only(['antecedentes','tratamiento']));
        return response()->json($historiaClinica);
    }

    public function destroy(HistoriaClinica $historiaClinica)
    {
        $historiaClinica->delete();
        return response()->json(null, 204);
    }
}
