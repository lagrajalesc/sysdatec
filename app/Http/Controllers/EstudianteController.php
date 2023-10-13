<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Estudiante;

class EstudianteController extends Controller
{
    public function crearEstudiante(Request $request){

        try{
            DB::beginTransaction();

            if(empty($request->nombre)){
                return response()->json([
                    'message' => 'Debe indicar el nombre del estudiante, por favor, valide',
                    'status' => '400',
                ]);
            };
            if(empty($request->apellido)){
                return response()->json([
                    'message' => 'Debe indicar el apellido del estudiante, por favor, valide',
                    'status' => '400',
                ]);
            };
            if(empty($request->correo)){
                return response()->json([
                    'message' => 'Debe indicar el correo del estudiante, por favor, valide',
                    'status' => '400',
                ]);
            };

            Estudiante::create([
                'nombres' => $request->nombre,
                'apellido' => $request->apellido,
                'correo' => $request->correo,
                'id_estado' => 1
            ]);

            DB::commit();
            return response()->json([
                'message' => 'El Estudiante se ha creado correctamente',
                'status' => '200',
            ]);

        } catch(Throwable $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Se presentó un error tratando de crear el nuevo estudiante',
                'error' => $e,
                'status' => '400',
            ]);

        }
    }

    public function verEstudiantes(){
        try{
            
            $estudiante = Estudiante::where('id_estado', '=', 1)->get();
            if(count($estudiante) != 0){
                return response()->json([
                    'message' => 'Estos son los estudiantes obtenidos',
                    'status' => '200',
                    'estudiantes' => $estudiante
                ]);
            }

            return response()->json([
                'message' => 'No se encontraron estudiantes',
                'status' => '204',
            ]);

        } catch(Throwable $e){
            return response()->json([
                'message' => 'Se presentó un error tratando de mostrar los estudiantes',
                'error' => $e,
                'status' => '400',
            ]);
        }
    }

    public function eliminarEstudiante(Request $request){
        try{
            DB::beginTransaction();

            if(empty($request->id)){
                return response()->json([
                    'message' => 'Debe indicar el id del estudiante, por favor, valide',
                    'status' => '400',
                ]);
            };

            $estudiantes = Estudiante::find($request->id);
            if(!empty($estudiantes)){

                Estudiante::where('id', '=', $request->id)
                        ->update(['id_estado' => 2]);  

                DB::commit();
                return response()->json([
                    'message' => 'El Estudiante se ha creado correctamente',
                    'status' => '200',
                ]);
            }

            return response()->json([
                'message' => 'No se encontró un estudiante con el id indicado, por favor, valide',
                'status' => '200',
            ]);
        }catch(Throwable $e){
            DB::rollback();
            return response()->json([
                'message' => 'Se presentó un error tratando de eliminar el estudiantes',
                'error' => $e,
                'status' => '400',
            ]);
        }
    }

}
