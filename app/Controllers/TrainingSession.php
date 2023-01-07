<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\TrainingSessionModel;

class TrainingSession extends ResourceController {
    use ResponseTrait;

    public function index() {
        $model = new TrainingSessionModel();
        $data = $model->getTrainingSessions();
        return $this->respond($data, 200);
    }

    public function show($id = null) {
        $model = new TrainingSessionModel();
        $data = $model->getTrainingSession($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No Data Found with id ' . $id);
        }
    }

    public function create() {
        $model = new TrainingSessionModel();
        $data = [
            'workout_id' => $this->request->getPost('workout_id'),
            'day' => $this->request->getPost('day'),
            'name' => $this->request->getPost('name')
        ];
        $model->insertTrainingSession($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];

        return $this->respondCreated($data, 201);
    }

    public function update($id = null)
    {
        $model = new TrainingSessionModel();
        $json = $this->request->getJSON();
        if ($json) {
            $data = [
                'workout_id' => $json->workout_id,
                'day' => $json->day,
                'name' => $json->name
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'workout_id' => $input['workout_id'],
                'day' => $input['day'],
                'name' => $input['name']
            ];
        }
        $model->updateTrainingSession($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }

    public function delete($id = null)
    {
        $model = new TrainingSessionModel();
        $data = $model->getTrainingSession($id);
        if ($data) {
            $model->deleteTrainingSession($id);
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
