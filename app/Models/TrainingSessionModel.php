<?php

namespace App\Models;

use CodeIgniter\Model;

class TrainingSessionModel extends Model {
    protected $table = 'training_session';
    protected $primaryKey = 'id';

    public function getTrainingSessions() {
        return $this->db->table($this->table)->get()->getResult();
    }

    public function getTrainingSession($id) {
        return $this->db->table($this->table)->getWhere([$this->primaryKey => $id])->getRow();
    }

    public function getTrainingSessionsByWorkoutId($workout_id) {
        return $this->db->table($this->table)->where('workout_id', $workout_id)->get()->getResult();
    }
    

    public function insertTrainingSession($data) {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateTrainingSession($id, $data) {
        return $this->db->table($this->table)->update($data, [$this->primaryKey => $id]);
    }

    public function deleteTrainingSession($id) {
        return $this->db->table($this->table)->delete([$this->primaryKey => $id]);
    }
}