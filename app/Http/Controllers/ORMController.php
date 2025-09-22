<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FichaMedica;
use Illuminate\Http\Request;

class ORMController extends Controller
{
    // Obtener todos los usuarios con sus fichas médicas y las historias clínicas asociadas
    public function usuariosConFichas()
    {
        $data = User::with('fichaMedica.historiaClinica')->get();
        return response()->json($data);
    }

    // Consultar fichas médicas con filtro (ejemplo: peso mayor a 70)
    public function fichasConFiltro()
    {
        $data = FichaMedica::with('user', 'historiaClinica')
            ->where('peso', '>', 70)
            ->get();
        return response()->json($data);
    }

    // Consulta anidada: usuarios que tengan fichas médicas y esas fichas tengan historias clínicas
    public function usuariosConHistoria()
    {
        $data = User::whereHas('fichaMedica.historiaClinica')
            ->with('fichaMedica.historiaClinica')
            ->get();

        return response()->json($data);
    }
    
}
