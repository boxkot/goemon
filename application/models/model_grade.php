<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_grade extends CI_Model
{
    private $_table = 'grade';

    public function getAll()
    {
        $this->db->select()
            ->from($this->_table)
            ->order_by('id');

        return $this->db->get()->result_array();
    }

}