<?php

namespace App\Models;

use CodeIgniter\Model;

class WorkoutModel extends Model {
    protected $table = 'workout';
    protected $primaryKey = 'id';

    public function getWorkouts() {
        return $this->db->table($this->table)->get()->getResult();
    }

    public function getWorkout($id) {
        return $this->db->table($this->table)->getWhere([$this->primaryKey => $id])->getRow();
    }

    public function insertWorkout($data) {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateWorkout($id, $data) {
        return $this->db->table($this->table)->update($data, [$this->primaryKey => $id]);
    }

    public function deleteWorkout($id) {
        return $this->db->table($this->table)->delete([$this->primaryKey => $id]);
    }
}