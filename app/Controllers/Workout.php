<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\WorkoutModel;

class Workout extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $model = new WorkoutModel();
        $data = $model->getWorkouts();
        return $this->respond($data, 200);
    }

    public function show($id = null)
    {
        $model = new WorkoutModel();
        $data = $model->getWorkout($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }

    public function create()
    {
        $model = new WorkoutModel();
        $data = [
            'user_id' => $this->request->getPost('user_id'),
            'workout_type_id' => $this->request->getPost('workout_type_id'),
            'name' => $this->request->getPost('name'),
            'num_days' => $this->request->getPost('num_days')
        ];
        $model->insertWorkout($data);
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
        $model = new WorkoutModel();
        $json = $this->request->getJSON();
        if ($json) {
            $data = [
                'user_id' => $json->user_id,
                'workout_type_id' => $json->workout_type_id,
                'name' => $json->name,
                'num_days' => $json->num_days
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'user_id' => $input['user_id'],
                'workout_type_id' => $input['workout_type_id'],
                'name' => $input['name'],
                'num_days' => $input['num_days']
            ];
        }
        $model->updateWorkout($id, $data);
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
        $model = new WorkoutModel();
        $data = $model->getWorkout($id);
        if ($data) {
            $model->deleteWorkout($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('No Data Found with id '.$id);
        }    
    }
}