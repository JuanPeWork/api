<?php
namespace App\Models;
use CodeIgniter\Model;


class ExerciseModel extends Model {

    protected $table = 'exercise';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','training_session_id','name','sets','repts','weight','created_at','updated_at'];

    public function __construct(){
		parent ::__construct();
        // $this->load->library('json');
		//$this->load->database();
        // $this->load->helper('url');
    }

    public function getExercises() {
        return $this->db->table($this->table)->get()->getResult();
    }

    public function getExercisesByTrainingSessionId($training_session_id) {
        return $this->db->table($this->table)->where('training_session_id', $training_session_id)->get()->getResult();
    }

    public function getExercise($id) {
        return $this->db->table($this->table)->getWhere([$this->primaryKey => $id])->getRow();
    }

    public function insertExercise($data) {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateExercise($id, $data) {
        return $this->db->table($this->table)->update($data, [$this->primaryKey => $id]);
    }
    public function updateExerciseVolume($id, $repts, $weight) {
        $data = [
            'repts' => $repts,
            'weight' => $weight
        ];

        $this->db->table($this->table)->update($data, [$this->primaryKey => $id]);
    }


    public function deleteExercise($id) {
        return $this->db->table($this->table)->delete([$this->primaryKey => $id]);
    }
}