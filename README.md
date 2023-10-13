# sysdatec
Backend prueba técnica

Requisitos: mysql, php 8.2., composer 2.5.8, postman 

Clone el repositorio y cree una base de datos llamada sysdatec y ejecute el comando: php artisan migrate, esto creará las tablas necesarias
vaya a la base de datos y ejecute lo scripts: 
INSERT INTO estados (estado) VALUES ('Activo') -> este primero, es importante que este quede como id = 1
INSERT INTO estados (estado) VALUES ('Inactivo')

levante el proyecto con el comando: php artisan serve y luego vaya a postman y pruebe las api

// ESTUDIANTES
mediante el método post: http://127.0.0.1:8000/api/crearEstudiante y en formato json, esto le permitirá crear un nuevo estudiante 

{
    "nombre" : "string",
    "apellido" : "string",
    "correo" : "string"
}

mediante el método post: http://127.0.0.1:8000/api/eliminarEstudiante y en formato json, esto le permitirá cambiar el estado de activo a incativo de un estudiante

{
    "id" : 1
}

mediante el método get: http://127.0.0.1:8000/api/verEstudiantes le permitirá ver todos los estudiantes que se encuentran activos

// PROFESORES

mediante el método post: http://127.0.0.1:8000/api/crearProfesor y en formato json, esto le permitirá crear un nuevo profesor 

{
    "nombre" : "string",
    "apellido" : "string",
    "correo" : "string"
}

mediante el método post: http://127.0.0.1:8000/api/eliminarProfesor y en formato json, esto le permitirá cambiar el estado de activo a incativo de un profesor

{
    "id" : 2
}

mediante el método get: http://127.0.0.1:8000/api/verProfesor le permitirá ver todos los profesores que se encuentran activos

// MATERIAS
mediante el método get: http://127.0.0.1:8000/api/verMaterias e permitirá ver todas las materias

mediante el método post: http://127.0.0.1:8000/api/crearMateria en formato json, le permitirá crear una nueva materia

{
    "nombre" : "string",
    "codigo" : "string" máximo 6 caracteres
}

// MATRICULAR MATERIAS
mediante el método post: http://127.0.0.1:8000/api/verMatriculados en formato json, le permitiráver los estudiantes matriculados en una materia
{
    "id" : int ->id de la materia en que desee conocer los estudiantes matriculados 
}

mediante el método post: http://127.0.0.1:8000/api/matricularMateria en formato json, le permitiráver a un estudiante matricular una materia
{
    "id_estudiante" : int, id del estudiante que se matriculará
    "id_materia" : int, id de la materia en que se matriculará al estudiante
}

mediante el método post: http://127.0.0.1:8000/api/cancelarMateria en formato json, le permitiráver a un estudiante cancelar una materia

{
    "id_estudiante" : int, id del estudiante que cancelará la materia
    "id_materia" : int, id de la materia en que el estudiante va a cancelar
}

// ASIGNAR PROFESORES
mediante el método post: http://127.0.0.1:8000/api/asignarProfesor en formato json, le permitirá a asignar un prodesor a una materia

{
    "id_profesor" : int, id del profesor que dictará el curso
    "id_materia" : int, id de la materia que dictará el profesor
}

mediante el método post: http://127.0.0.1:8000/api/cancelarProfesor en formato json, le permitirá cancelarle la materia a un profesor(ya no dictará el curso)

{
    "id_profesor" : int, id del profesor 
    "id_materia" : int, id de la materia
}



