<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_report extends CI_Model
{
    private $_table = 'report';

    public function get($id)
    {
        $this->db->select()
                 ->from($this->_table)
                 ->where('id', $id);

        return $this->db->get()->row_array();
    }

    public function getDetail($id)
    {
        $column = array(
            'id'         => 'a.id',
            'title'      => 'a.title',
            'content'    => 'a.content',
            'created_at' => 'DATE_FORMAT(a.created_at, "%Y/%m/%d %H:%i")',
            'user_id'    => 'b.id',
            'name'       => 'b.name',
            'unit_name'  => 'c.name',
        );

        $this->db->select(toColumn($column), false)
                 ->from(toColumn('a', $this->_table))
                 ->join(toColumn('b', 'user'), 'a.user_id = b.id', 'left')
                 ->join(toColumn('c', 'unit'), 'b.unit_id = c.id', 'left')
                 ->where('a.id', $id);

        return $this->db->get()->row_array();
    }

    public function getMyReport($id, $limit = 10, $per = 0)
    {
        $column = array(
            'id'         => 'id',
            'title'      => 'title',
            'created_at' => 'DATE_FORMAT(created_at, "%Y/%m/%d %H:%i")',
        );

        $this->db->select(toColumn($column), false)
                 ->from($this->_table)
                 ->where('id', $id)
                 ->order_by('created_at', 'desc')
                 ->limit($limit, $per * 10);

        return $this->db->get()->result_array();
    }

    public function getNew($id, $limit = 5)
    {
        $this->db->select()
                 ->from($this->_table)
                 ->where('user_id <>', $id)
                 ->order_by('created_at', 'desc')
                 ->limit($limit);

        return $this->db->get()->result_array();
    }

    public function add($data)
    {
        //トランザクション開始
        $this->db->trans_start();

        $data['created_at'] = (new DateTime())->format('Y-m-d H:i:s');
        $this->db->insert($this->_table, $data);
        //コミット
        $this->db->trans_complete();

        return $this->db->trans_status();
    }

}