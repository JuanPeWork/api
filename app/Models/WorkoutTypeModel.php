<?php
namespace App\Models;
use CodeIgniter\Model;

class WorkoutTypeModel extends Model
{
    protected $table = 'workout_type';
    protected $primaryKey = 'id';

    public function getWorkoutTypes() {
        return $this->db->table($this->table)->get()->getResult();
    }

    public function getWorkoutType($id) {
        return $this->db->table($this->table)->getWhere([$this->primaryKey => $id])->getRow();
    }

    public function insertWorkoutType($data) {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateWorkoutType($id, $data) {
        return $this->db->table($this->table)->update($data, [$this->primaryKey => $id]);
    }

    public function deleteWorkoutType($id) {
        return $this->db->table($this->table)->delete([$this->primaryKey => $id]);
    }
}