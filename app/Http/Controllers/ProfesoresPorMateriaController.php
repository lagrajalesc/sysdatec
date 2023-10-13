<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProfesoresPorMateria;
use App\Models\Profesor;
use App\Models\Materia;

class ProfesoresPorMateriaController extends Controller
{
    public function asignarProfesor(Request $request){
        try{
            DB::beginTransaction();
            
            $validateData= collect($this->validateData($request));
            if($validateData['original']['status'] == 400){
                return response()->json([
                    'message' => $validateData['original']['message'],
                    'status' => '400',
                ]);
            }
            
            ProfesoresPorMateria::create([
                'id_profesor' => $request->id_profesor,
                'id_materia' => $request->id_materia,
            ]);

            DB::commit();
            return response()->json([
                'message' => 'El profesor se ha asignado correctamente',
                'status' => '200',
            ]);

        } catch(Throwable $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Se presentó un error tratando de asignar al profesor',
                'error' => $e,
                'status' => '400',
            ]);

        }
    }

    public function cancelarProfesor(Request $request){
        try{
            DB::beginTransaction();

            $validateData= collect($this->validateData($request));
            if($validateData['original']['status'] == 400){
                return response()->json([
                    'message' => $validateData['original']['message'],
                    'status' => '400',
                ]);
            }
            
            ProfesoresPorMateria::where([
                'id_profesor' => $request->id_profesor,
                'id_materia' => $request->id_materia,
            ])->delete();

            DB::commit();
            return response()->json([
                'message' => 'La materia se ha cancelado correctamente',
                'status' => '200',
            ]);

        } catch(Throwable $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Se presentó un error tratando de cancelar la materia',
                'error' => $e,
                'status' => '400',
            ]);

        }
    }

    public function validateData(Request $request){
        if(empty($request->id_profesor)){
            return response()->json([
                'message' => 'Debe indicar el id del profesor, por favor, valide',
                'status' => '400',
            ]);
        };
        if(empty($request->id_materia)){
            return response()->json([
                'message' => 'Debe indicar el id del materia, por favor, valide',
                'status' => '400',
            ]);
        };

        $profesor = Profesor::where('id', '=', $request->id_profesor)->get();
        if(count($profesor) == 0){
            return response()->json([
                'message' => 'No existe un profesor con el id indicado, por favor, valide',
                'status' => '400',
            ]);
        }
        if(($profesor[0]->id_estado != 1)){
            return response()->json([
                'message' => 'No existe un profesor con el id indicado, por favor, valide',
                'status' => '400',
            ]);
        }

        $materia = Materia::find($request->id_materia);
        if(empty($materia)){
            return response()->json([
                'message' => 'No existe una materia con el id indicado, por favor, valide',
                'status' => '400',
            ]);
        }
        return response()->json([
            'message' => 'Validación correcta',
            'status' => '200',
        ]);
    }
}
