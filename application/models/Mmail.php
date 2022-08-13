<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * This Model for Mail only
 */
class Mmail extends CI_Model{

    function __construct(){
        parent::__construct();

        $this->load->database();
    }

    public function getMails($limit = NULL) {

        $query =  $this->db->get('mail_queue');

        if ($limit != NULL) {
            $this->db->limit($limit);
        }

        return $query->result_array();
    }

    public function delete($id) {
        $this->db->where('id',$id);
        $this->db->delete('mail_queue');
    }

    public function insert($data) {
        return $this->db->insert('mail_queue', $data);
    }

    public function getMailConfig() {
        $query =  $this->db->get('mail_config');
        return $query->row_array();
    }

}
