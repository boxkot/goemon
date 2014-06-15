<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_comment extends CI_Model
{
    private $_table = 'comment';

    public function getNum($id)
    {
        $this->db->select()
                 ->from($this->_table)
                 ->where('report_id', $id);

        return $this->db->count_all_results();
    }

    public function getComment($id)
    {
        $column = array(
            'content' => 'a.content',
            'name'    => 'b.name',
            'user_id' => 'b.id',
        );

        $this->db->select(toColumn($column))
                 ->from(toColumn('a', $this->_table))
                 ->join(toColumn('b', 'user'), 'a.user_id = b.id', 'left')
                 ->where('a.report_id', $id);

        return $this->db->get()->result_array();
    }

}