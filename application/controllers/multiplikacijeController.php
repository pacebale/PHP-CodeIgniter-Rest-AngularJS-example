<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class multiplikacijeController extends CI_Controller {
    
    public function index(){
        $model = $this->load->model('mikrokreditna_multiplikacija_model', 'makroModel');
        $result =  $this->makroModel->getAll();
        
        foreach($result as  $value){
            echo serialize($value);
        }
    }
}
