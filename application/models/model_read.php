<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_read extends CI_Model
{
    private $_table = 'read';

    public function getNum($id)
    {
        $this->db->select()
                 ->from($this->_table)
                 ->where('report_id', $id);

        return $this->db->count_all_results();
    }

    public function getUser($id)
    {
        $column = array(
            'name'    => 'b.name',
            'user_id' => 'b.id',
        );

        $this->db->select(toColumn($column))
                 ->from(toColumn('a', $this->_table))
                 ->join(toColumn('b', 'user'), 'a.user_id = b.id', 'left')
                 ->where('a.id', $id);


        return $this->db->get()->result_array();
    }

}