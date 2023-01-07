<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\WorkoutTypeModel;

class WorkoutType extends ResourceController {
    protected $model;

    public function __construct() {
        $this->model = new WorkoutTypeModel();
    }

    public function index() {
        // Obtiene todos los tipos de entrenamiento
        $workoutTypes = $this->model->getWorkoutTypes();

        // Devuelve una respuesta con un código de éxito 200 (OK) y la lista de tipos de entrenamiento
        return $this->respond($workoutTypes, 200);
    }

    public function show($id = null) {
        // Obtiene el tipo de entrenamiento con el ID especificado
        $workoutType = $this->model->getWorkoutType($id);

        if ($workoutType) {
            // Si se encuentra el tipo de entrenamiento, devuelve una respuesta con un código de éxito 200 (OK) y la información del tipo de entrenamiento
            return $this->respond($workoutType, 200);
        } else {
            // Si no se encuentra el tipo de entrenamiento, devuelve una respuesta de error 404 (Not Found)
            return $this->failNotFound('Workout type not found');
        }
    }

    public function create() {
        // Crea un nuevo tipo de entrenamiento con la información enviada en la solicitud
        $data = [
            'name' => $this->request->getPost('name'),
        ];

        $this->model->insertWorkoutType($data);

        // Devuelve una respuesta con un código de éxito 201 (Created) y la información del nuevo tipo de entrenamiento
        return $this->respondCreated($data, 201);
    }

    public function update($id = null) {
        // Obtiene el tipo de entrenamiento con el ID especificado
        $workoutType = $this->model->getWorkoutType($id);

        if ($workoutType) {
            // Obtiene los datos enviados en la solicitud
            $data = $this->request->getJSON();
            // Actualiza el tipo de entrenamiento con la información enviada en la solicitud
            $this->model->updateWorkoutType($id, $data);

            // Devuelve una respuesta con un código de éxito 200 (OK) y la información actualizada del tipo de entrenamiento
            return $this->respond($data, 200);
        } else {
            // Si no se encuentra el tipo de entrenamiento, devuelve una respuesta de error 404 (Not Found)
            return $this->failNotFound('Workout type not found');
        }
    }

    public function delete($id = null) {
        // Obtiene el tipo de entrenamiento con el ID especificado
        $workoutType = $this->model->getWorkoutType($id);

        if ($workoutType) {
            // Elimina el tipo de entrenamiento con el ID especificado
            $this->model->deleteWorkoutType($id);

            // Devuelve una respuesta con un código de éxito 204 (No Content)
            return $this->respondNoContent();
        } else {
            // Si no se encuentra el tipo de entrenamiento, devuelve una respuesta de error 404 (Not Found)
            return $this->failNotFound('Workout type not found');
        }
    }
}
