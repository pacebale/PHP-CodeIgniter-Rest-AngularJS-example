<?php

/*
 * Connected with makrokreditna_multiplikacija table in database
 */
 class makrokreditna_multiplikacija_model extends CI_Model {
    
    // <editor-fold defaultstate="collapsed" desc="Public methods">
     
    /*
     * Gets all entites from database
     * @return array of entites
     */
    public function getAll(){
        $query = $this->db->get('makrokreditna_multiplikacija');
        return $query->result();
    }
    
     /*
     * Inserts entity into database
     * @param double $depoziti 
     * @param double $rezerve
     * @param double $krediti
     * @return true if success, false otherwise
     */
    public function add($depoziti, $rezerve, $krediti){
        
        $data = array(
            'depoziti' => $depoziti,
            'rezerve' => $rezerve,
            'krediti' => $krediti
        );
        
        $query = $this->db->insert('makrokreditna_multiplikacija', $data);
        return $query->result();
    }
    
    /*
     * Deletes entity from database
     * @param int $id - entity id
     * @return mixed - CI_DB_query_builder instance (method chaining) or FALSE on failure
     */
    public function delete($id){
        $this->db->delete('makrokreditna_multiplikacija', [ 'id' => $id] );
    }
    
    // </editor-fold>
}
