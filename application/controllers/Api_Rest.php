<?php

require(APPPATH . 'libraries/REST_controller.php');

class Api_Rest extends REST_Controller {
    /*
     * Constructor
     */

    function __construct() {
        parent::__construct();
        $this->load->model('database_model', 'model');
    }

    /*
     * Gets all database tables
     */

    function all_get() {

        $data = $this->model->getAll();

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(null, 204);
        }   // 204 - No Content
    }

    /*
     * Gets table where name is like...
     */

    function where_get() {

        $name = $this->get('name');
        $data = $this->model->getWhere($name);


        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(204);
        }
    }

    /*
     * Delete method
     * Expects type and id as parameters
     * type - mikro or makro
     * id - int
     */

    function delete_delete() {

        $id = $this->get('id');
        $this->model->delete($id);
        $this->response(null, 200);
    }

    /*
     * Get by id
     */

    function byId_get() {
        $id = $this->get('id');
        $result = $this->model->getById($id);

        if ($result) {
            $this->response($result[0], 200);
        } else {
            $this->response(null, 204);
        }
    }

    /*
     * Calculates table values
     */

    function calculate_post() {

        $depozit = $this->post('depo');
        $stopaObvezneRezerve = $this->post('rez');
        $stopaPovrataDepozita = $this->post('pov');
        $brojRazdoblja = $this->post('raz');

        $multi = array();
        $rezerve = $depozit * $stopaObvezneRezerve;
        $krediti = $depozit - $rezerve;

        for ($x = 0; $x < $brojRazdoblja; $x++) {

            $obj = (object) array(
                        'depoziti' => $depozit,
                        'rezerve' => $rezerve,
                        'krediti' => $krediti);

            array_push($multi, $obj);

            $z = (1 - $stopaObvezneRezerve) * $stopaPovrataDepozita;
            $depozit *= $z;
            $rezerve = $depozit * $stopaObvezneRezerve;
            $krediti = $depozit - $rezerve;
        }

        $this->response($multi, 200);
    }

    /*
     * Updates entity
     */

    function update_put() {

        $data = $this->put('data');

        $id = $data['id'];
        $toDatabase = (object) ['Naziv' => $this->put('tableName'),
                    'Razdoblje' => $data['raz'],
                    'Rezerve' => $data['rez'],
                    'Krediti' => $data['pov'],
                    'Depoziti' => $data['depo']
        ];

        $result = $this->model->update($id, $toDatabase);

        if ($result > 0) {
            $this->response($result, 201);
        } else {
            $this->response(304);
        }
    }

    /*
     * Saves data
     */

    function save_post() {

        $data = $this->post('data');


        $toDatabase = (object) ['Naziv' => $this->post('tableName'),
                    'Razdoblje' => $data['raz'],
                    'Rezerve' => $data['rez'],
                    'Krediti' => $data['pov'],
                    'Depoziti' => $data['depo']
        ];

        $result = $this->model->add($toDatabase);

        if ($result > 0) {
            $this->response($result, 201);
        } else {
            $this->response(304);
        }
    }

}
