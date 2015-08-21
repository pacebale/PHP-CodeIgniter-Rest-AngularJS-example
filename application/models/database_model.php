<?php

/*
 * Model with database and tables creation responsibility
 */

class database_model extends CI_Model {

    // <editor-fold defaultstate="collapsed" desc="constructor">

    /*
     * Constructor
     */
    public function __construct() {
        parent::__construct();

        $this->load->dbutil();
        $this->load->dbforge();

        if (!$this->dbutil->database_exists('multiplikator')) {
            $this->dbforge->create_database('multiplikator');
        }

        // Moved tables to another method, to reduce code bloat
        $this->create_user_tables($this->dbforge);
    }

    // </editor-fold>
    // 
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
            ),
            'Razdoblje' => array(
                'type' => 'INT'
            ),
            'Naziv' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            )
        );

        $dbforge->add_field('id');
        $dbforge->add_field($fields);
        $dbforge->create_table('kreditna_multiplikacija', true);
    }

    //</editor-fold>
    //
    // <editor-fold defaultstate="collapsed" desc="public methods">

    /*
     * Gets all entites from database
     * @return array - collection of entites
     */
    public function getAll() {

        $query = $this->db->get('kreditna_multiplikacija');

        return $query->result();
    }

    /*
     * Get where name is like
     * @param string name
     * @return table reuslt
     */

    public function getWhere($name) {

        $this->db->like('Naziv', $name);
        $query = $this->db->get('kreditna_multiplikacija');

        return $query->result();
    }
    
     /*
     * get by id
     */
    public function getById($id) {

        $this->db->where('id', $id);
        $query = $this->db->get('kreditna_multiplikacija');

        return $query->result();
    }

    /*
     * Inserts entity into database
     * @return bool - True if success, false otherwise
     */

    public function add($data) {

        $query = $this->db->insert('kreditna_multiplikacija', $data);
        $num_inserts = $this->db->affected_rows();
        return $num_inserts;
    }
    
     /*
     * Updates entity
     * int id
     * object data
     */
    public function update($id, $data) {
        
        $this->db->where('id', $id);
        $this->db->update('kreditna_multiplikacija', $data);
        $num_inserts = $this->db->affected_rows();
        return $num_inserts;
    }

    /*
     * Deletes entity from database
     * @param int $id - entity id
     * @return mixed - CI_DB_query_builder instance (method chaining) or FALSE on failure
     */

    public function delete($id) {
        $this->db->delete('kreditna_multiplikacija', [ 'id' => $id]);
    }

    // </editor-fold>
}
