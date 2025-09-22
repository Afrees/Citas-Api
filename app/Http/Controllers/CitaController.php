<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        return Cita::with('user', 'examenes')->get();
    }

    public function store(Request $request)
    {
        $cita = Cita::create($request->only(['user_id','fecha','descripcion']));
        return response()->json($cita, 201);
    }

    public function show(Cita $cita)
    {
        return $cita->load('user', 'examenes');
    }

    public function update(Request $request, Cita $cita)
    {
        $cita->update($request->only(['fecha','descripcion']));
        return response()->json($cita);
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();
        return response()->json(null, 204);
    }
}
