<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HomeController
 *
 * @author luka
 */
class HomeController extends CI_Controller {

    /*
     * Main function, load view
     */
    public function index(){
        $this->load->view("home_view");
    }
   
}
