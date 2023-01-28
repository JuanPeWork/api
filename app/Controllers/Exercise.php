<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ExerciseModel;

class Exercise extends ResourceController {
    use ResponseTrait;

    public function __construct(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization, Basic");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
    }

    public function index() {
        $model = new ExerciseModel();
        $data = $model->getExercises();
        return $this->respond($data, 200);
    }

    public function show($id = null) {
        $model = new ExerciseModel();
        $data = $model->getExercise($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No Data Found with id ' . $id);
        }
    }

    public function getExercisesByTrainingSessionId($training_session_id) {
        $model = new ExerciseModel();
        $data = $model->getExercisesByTrainingSessionId($training_session_id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No Data Found with training_session_id ' . $training_session_id);
        }
    }

    public function create() {
        $model = new ExerciseModel();
        $data = [
            'training_session_id' => $this->request->getPost('training_session_id'),
            'name' => $this->request->getPost('name'),
            'sets' => $this->request->getPost('sets'),
            'repts' => $this->request->getPost('repts'),
            'weight' => $this->request->getPost('weight')
        ];
        $model->insertExercise($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];

        return $this->respondCreated($data, 201);
    }

    public function update($id = null) {
        $model = new ExerciseModel();
        $json = $this->request->getJSON();
        if ($json) {
            $data = [
                'training_session_id' => $json->training_session_id,
                'name' => $json->name,
                'sets' => $json->sets,
                'repts' => $json->repts,
                'weight' => $json->weight
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'training_session_id' => $input['training_session_id'],
                'name' => $input['name'],
                'sets' => $input['sets'],
                'repts' => $input['repts'],
                'weight' => $input['weight']
            ];
        }
        $model->updateExercise($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }

    public function updateExerciseVolume($id = null) {
        $model = new ExerciseModel();

        // Obtener los datos enviados en el cuerpo de la petición
        $data = $this->request->getJSON();

        // Verificar que los datos requeridos estén presentes
        if (!isset($data->repts) || !isset($data->weight)) {
            return $this->failValidationErrors('repts and weight are required fields');
        }

        // Actualizar solo los campos necesarios en la tabla
        $model->updateExerciseVolume($id, $data->repts, $data->weight);

        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Exercise volume updated'
            ]
        ];
        return $this->respond($response);
    }


    public function delete($id = null) {
        $model = new ExerciseModel();
        $data = $model->getExercise($id);
        if ($data) {
            $model->deleteExercise($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('No Data Found with id ' . $id);
        }
    }
}