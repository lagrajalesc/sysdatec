<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EstudiantesPorMateria;
use App\Models\Estudiante;
use App\Models\Materia;

class EstudiantesPorMateriaController extends Controller
{
    public function matricularMateria(Request $request){
        try{
            DB::beginTransaction();

            $validateData= collect($this->validateData($request));
            if($validateData['original']['status'] == 400){
                return response()->json([
                    'message' => $validateData['original']['message'],
                    'status' => '400',
                ]);
            }

            $materias = DB::table('materia')
            ->select(DB::raw('COUNT(DISTINCT(estudiantes_por_materia.id)) AS matriculados'))
            ->join('estudiantes_por_materia', 'materia.id', '=', 'estudiantes_por_materia.id_materia')
            ->join('estudiante', 'estudiantes_por_materia.id_estudiante', 'estudiante.id')
            ->where('materia.id', '=', $request->id_materia)
            ->get();

            if(count($materias) > 20){
                return response()->json([
                    'message' => 'Ya el grupo está lleno, intenta matricular con otro profesor',
                    'status' => '400',
                ]);
            }
            
            EstudiantesPorMateria::create([
                'id_estudiante' => $request->id_estudiante,
                'id_materia' => $request->id_materia,
            ]);

            DB::commit();
            return response()->json([
                'message' => 'El Estudiante se ha matriculado correctamente',
                'status' => '200',
            ]);

        } catch(Throwable $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Se presentó un error tratando de matricular el estudiante',
                'error' => $e,
                'status' => '400',
            ]);

        }
    }

    public function cancelarMateria(Request $request){
        try{
            DB::beginTransaction();

            $validateData= collect($this->validateData($request));
            if($validateData['original']['status'] == 400){
                return response()->json([
                    'message' => $validateData['original']['message'],
                    'status' => '400',
                ]);
            }
            
            EstudiantesPorMateria::where([
                'id_estudiante' => $request->id_estudiante,
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

    public function verMatriculados(Request $request){
        try{

            if(empty($request->id)){
                return response()->json([
                'message' => 'Debe indicar el id de la materia, por favor, valide',
                'status' => '204',
                ]);
            };

            $materias = DB::table('materia')
                        ->select(DB::raw('CONCAT(estudiante.nombres, " ", estudiante.apellido) AS estudiante'))
                        ->join('estudiantes_por_materia', 'materia.id', '=', 'estudiantes_por_materia.id_materia')
                        ->join('estudiante', 'estudiantes_por_materia.id_estudiante', 'estudiante.id')
                        ->where('materia.id', '=', $request->id)
                        ->get();

            if(empty($materias)){
                return response()->json([
                    'message' => 'No hay estudiantes matriculados en esta materia',
                    'status' => '204',
                ]);
            }

            return response()->json([
                'message' => 'Estos son los estudiantes matriculados',
                'status' => '200',
                'estudiantes' => $materias
            ]);


        }catch(Throwable $e) {
            return response()->json([
                'message' => 'Se presentó un error tratando de cancelar la materia',
                'error' => $e,
                'status' => '400',
            ]);

        }
    }


    public function validateData(Request $request){
        if(empty($request->id_estudiante)){
            return response()->json([
                'message' => 'Debe indicar el id de la estudiante, por favor, valide',
                'status' => '400',
            ]);
        };
        if(empty($request->id_materia)){
            return response()->json([
                'message' => 'Debe indicar el id del materia, por favor, valide',
                'status' => '400',
            ]);
        };

        $estudiante = Estudiante::where('id', '=', $request->id_estudiante)->get();

        if(!empty($estudiante)){
            if(($estudiante[0]->id_estado != 1)){
                return response()->json([
                    'message' => 'No existe un estudiante con el id indicado, por favor, valide',
                    'status' => '400',
                ]);
            }
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
