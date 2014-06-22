<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_unit extends CI_Model
{
    private $_table = 'unit';

    public function getAll()
    {
        $this->db->select()
            ->from($this->_table)
            ->order_by('id');

        return $this->db->get()->result_array();
    }

}