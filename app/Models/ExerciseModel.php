<?php
namespace App\Models;
use CodeIgniter\Model;


class ExerciseModel extends Model {

    protected $table = 'exercise';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','training_session_id','name','sets','repts','weight','created_at','updated_at'];

    public function __construct(){
		parent ::__construct();
        $this->load->library('json');
		$this->load->database();
        $this->load->helper('url');
    }

    public function getExercises() {
        return $this->db->table($this->table)->get()->getResult();
    }



}