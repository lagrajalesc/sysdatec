<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\EstudiantesPorMateriaController;
use App\Http\Controllers\ProfesoresPorMateriaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Estudiantes
Route::get('/verEstudiantes', [EstudianteController::class, 'verEstudiantes']);
Route::post('/crearEstudiante', [EstudianteController::class, 'crearEstudiante']);
Route::post('/eliminarEstudiante', [EstudianteController::class, 'eliminarEstudiante']);

// Profesores
Route::get('/verProfesor', [ProfesorController::class, 'verProfesores']);
Route::post('/crearProfesor', [ProfesorController::class, 'crearProfesor']);
Route::post('/eliminarProfesor', [ProfesorController::class, 'eliminarProfesor']);

// Materias
Route::get('/verMaterias', [MateriaController::class, 'verMaterias']);
Route::post('/crearMateria', [MateriaController::class, 'crearMateria']);

// Matricula y cancelación de materias
Route::post('/verMatriculados', [EstudiantesPorMateriaController::class, 'verMatriculados']);
Route::post('/matricularMateria', [EstudiantesPorMateriaController::class, 'matricularMateria']);
Route::post('/cancelarMateria', [EstudiantesPorMateriaController::class, 'cancelarMateria']);

// Asignación de profesores
Route::post('/asignarProfesor', [ProfesoresPorMateriaController::class, 'asignarProfesor']);
Route::post('/cancelarProfesor', [ProfesoresPorMateriaController::class, 'cancelarProfesor']);



