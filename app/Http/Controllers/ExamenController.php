<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use Illuminate\Http\Request;

class ExamenController extends Controller
{
    public function index()
    {
        return Examen::with('cita')->get();
    }

    public function store(Request $request)
    {
        $examen = Examen::create($request->only(['cita_id','tipo','resultado']));
        return response()->json($examen, 201);
    }

    public function show(Examen $examen)
    {
        return $examen->load('cita');
    }

    public function update(Request $request, Examen $examen)
    {
        $examen->update($request->only(['tipo','resultado']));
        return response()->json($examen);
    }

    public function destroy(Examen $examen)
    {
        $examen->delete();
        return response()->json(null, 204);
    }
}
