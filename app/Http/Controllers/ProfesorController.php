<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Profesor;

class ProfesorController extends Controller
{
    public function verProfesores(){
        try{
            
            $profesor = Profesor::where('id_estado', '=', 1)->get();
            if(count($profesor) != 0){
                return response()->json([
                    'message' => 'Estos son los profesores obtenidos',
                    'status' => '200',
                    'profesores' => $profesor
                ]);
            }

            return response()->json([
                'message' => 'No se encontraron profesores',
                'status' => '204',
            ]);

        } catch(Throwable $e){
            return response()->json([
                'message' => 'Se presentó un error tratando de mostrar los profesores',
                'error' => $e,
                'status' => '400',
            ]);
        }
    }

    public function crearProfesor(Request $request){
        try{
            DB::beginTransaction();

            if(empty($request->nombre)){
                return response()->json([
                    'message' => 'Debe indicar el nombre del profesor, por favor, valide',
                    'status' => '400',
                ]);
            };
            if(empty($request->apellido)){
                return response()->json([
                    'message' => 'Debe indicar el apellido del profesor, por favor, valide',
                    'status' => '400',
                ]);
            };
            if(empty($request->correo)){
                return response()->json([
                    'message' => 'Debe indicar el correo del profesor, por favor, valide',
                    'status' => '400',
                ]);
            };

            Profesor::create([
                'nombres' => $request->nombre,
                'apellido' => $request->apellido,
                'correo' => $request->correo,
                'id_estado' => 1
            ]);

            DB::commit();
            return response()->json([
                'message' => 'El profesor se ha creado correctamente',
                'status' => '200',
            ]);

        } catch(Throwable $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Se presentó un error tratando de crear el nuevo profesor',
                'error' => $e,
                'status' => '400',
            ]);

        }
    }

    public function eliminarProfesor(Request $request){
        try{
            DB::beginTransaction();

            if(empty($request->id)){
                return response()->json([
                    'message' => 'Debe indicar el id del profesor, por favor, valide',
                    'status' => '400',
                ]);
            };

            $profesor = Profesor::find($request->id);
            if(!empty($profesor)){

                Profesor::where('id', '=', $request->id)
                        ->update(['id_estado' => 2]);  

                DB::commit();
                return response()->json([
                    'message' => 'El profesor se ha creado correctamente',
                    'status' => '200',
                ]);
            }

            return response()->json([
                'message' => 'No se encontró un profesor con el id indicado, por favor, valide',
                'status' => '200',
            ]);
        }catch(Throwable $e){
            DB::rollback();
            return response()->json([
                'message' => 'Se presentó un error tratando de eliminar el profesor',
                'error' => $e,
                'status' => '400',
            ]);
        }
    }
}
