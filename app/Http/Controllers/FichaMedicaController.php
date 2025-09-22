<?php

namespace App\Http\Controllers;

use App\Models\FichaMedica;
use Illuminate\Http\Request;

class FichaMedicaController extends Controller
{
    public function index()
    {
        return FichaMedica::with('user', 'historiaClinica')->get();
    }

    public function store(Request $request)
    {
        $ficha = FichaMedica::create($request->only(['user_id','peso','altura']));
        return response()->json($ficha, 201);
    }

    public function show(FichaMedica $fichaMedica)
    {
        return $fichaMedica->load('user', 'historiaClinica');
    }

    public function update(Request $request, FichaMedica $fichaMedica)
    {
        $fichaMedica->update($request->only(['peso','altura']));
        return response()->json($fichaMedica);
    }

    public function destroy(FichaMedica $fichaMedica)
    {
        $fichaMedica->delete();
        return response()->json(null, 204);
    }
}
