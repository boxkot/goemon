<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_favorite_group extends CI_Model
{
    private $_table = 'favorite_group';

    public function getList($id)
    {
        $this->db->select()
                 ->from($this->_table)
                 ->where('user_id', $id);

        return $this->db->get()->result_array();
    }

    public function add($data)
    {
        //トランザクション開始
        $this->db->trans_start();

        $this->db->set($data);
        $this->db->set('created_at', 'NOW()', false);
        $this->db->insert($this->_table);
        $id = $this->db->insert_id();

        $this->db->trans_complete();

        if ($this->db->trans_status()) {
            return $id;
        }

        return false;
    }

}