<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Materia;

class MateriaController extends Controller
{
    public function verMaterias(){
        try{
            
            if(count(Materia::all()) != 0){
                return response()->json([
                    'message' => 'Estos son las materias obtenidos',
                    'status' => '200',
                    'materias' => Materia::all()
                ]);
            }

            return response()->json([
                'message' => 'No se encontraron materias',
                'status' => '204',
            ]);

        } catch(Throwable $e){
            return response()->json([
                'message' => 'Se presentó un error tratando de mostrar las materias',
                'error' => $e,
                'status' => '400',
            ]);
        }
    }

    public function crearMateria(Request $request){
        try{
            DB::beginTransaction();

            if(empty($request->nombre)){
                return response()->json([
                    'message' => 'Debe indicar el nombre de la materia, por favor, valide',
                    'status' => '400',
                ]);
            };
            if(empty($request->codigo)){
                return response()->json([
                    'message' => 'Debe indicar el codigo de la materia, por favor, valide',
                    'status' => '400',
                ]);
            };
            if(strlen($request->codigo) > 6){
                return response()->json([
                    'message' => 'El código debe tener como máximo 6 caracteres, por favor, valide',
                    'status' => '400',
                ]);
            };
            Materia::create([
                'nombre' => $request->nombre,
                'codigo' => $request->codigo
            ]);

            DB::commit();
            return response()->json([
                'message' => 'La materia se ha creado correctamente',
                'status' => '200',
            ]);

        } catch(Throwable $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Se presentó un error tratando de crear la nueva materia',
                'error' => $e,
                'status' => '400',
            ]);

        }
    }
}
