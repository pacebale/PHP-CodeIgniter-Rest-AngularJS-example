<?php

/*
 * Model with database and tables creation responsibility
 */
 class create_database_model extends CI_Model {

    // <editor-fold defaultstate="collapsed" desc="constructor">

    /*
     * Constructor
     */
    public function __construct() {
        parent::__construct();

        $this->load->dbutil();
        $this->load->dbforge();

        if (!$this->dbutil->database_exists('multiplikatori')) {
            $this->dbforge->create_database('multiplikatori');
        }

        // Moved tables to another method, to reduce code bloat
        $this->create_user_tables($this->dbforge);
    }

    // </editor-fold>
    //<editor-fold defaultstate="collapsed" desc="private helper methods">

    /*
     * Private method
     * Creates two database tables 
     */
    private function create_user_tables($dbforge) {

        // Table fields
        $fields = array(
            'Depoziti' => array(
                'type' => 'DOUBLE',
            ),
            'Rezerve' => array(
                'type' => 'DOUBLE',
            ),
            'Krediti' => array(
                'type' => 'DOUBLE'
            )
        );

        // First table
        if (!$this->db->table_exists('mikrokreditna_multiplikacija')) {
            
            $dbforge->add_field('id');
            $dbforge->add_field($fields);
            $dbforge->create_table('mikrokreditna_multiplikacija', true);
        }

        // Second table
        if (!$this->db->table_exists('makrokreditna_multiplikacija')) {
            
            $dbforge->add_field('id');
            $dbforge->add_field($fields);
            $dbforge->create_table('makrokreditna_multiplikacija');
        }
    }

    //</editor-fold>
}
