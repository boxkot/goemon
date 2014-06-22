<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_auth extends CI_Model
{
    private $_table = 'auth';

    public function getAll()
    {
        $this->db->select()
            ->from($this->_table)
            ->order_by('id');

        return $this->db->get()->result_array();
    }

}