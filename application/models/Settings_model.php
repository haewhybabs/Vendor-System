<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings_model extends CI_Model
{

    public $table = 'mail_settings';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }
    
    function get_all()
    {
    return $this->db->get($this->table)->row();
    }
    
     function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }
    public function get_all_gen(){
        return $this->db->get('general_settings')->result();
    }
    public function gen_update($key_id,$update){
        $this->db->set($update)
        ->where('id',$key_id)
        ->update('general_settings');
    }
   

}

/* End of file Enrollee_model.php */
/* Location: ./application/models/Enrollee_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-06-06 18:15:49 */
/* http://harviacode.com */
