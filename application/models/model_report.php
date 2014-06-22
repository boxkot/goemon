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

    public function exists($id)
    {
        $this->db->select()
              ->from($this->_table)
              ->where('id', $id);

        return $this->db->get()->num_rows() === 1;
    }

    public function getAll($id)
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
                 ->where('a.id !=', $id)
                 ->order_by('created_at DESC')
                 ->limit(100);

        return $this->db->get()->result_array();
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
            'created_at' => 'DATE_FORMAT(FROM_UNIXTIME(created_at), "%Y/%m/%d %H:%i")',
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

    public function getRanking($order, $limit = 100)
    {
        $column = array(
            'id'          => 'a.id',
            'title'       => 'a.title',
            'created_at'  => 'FROM_UNIXTIME(a.created_at)',
            'read_num'    => 'COUNT(b.id)',
            'comment_num' => 'COUNT(c.id)',
            'user_name'   => 'd.name',
        );

        $this->db->select(toColumn($column), false)
                 ->from(toColumn('a', $this->_table))
                 ->join(toColumn('b', 'read'), 'a.id = b.report_id', 'left')
                 ->join(toColumn('c', 'comment'), 'a.id = c.report_id', 'left')
                 ->join(toColumn('d', 'user'), 'a.user_id = d.id', 'left')
                 ->group_by('a.id')
                 ->order_by('comment_num', 'desc')
                 ->order_by('read_num', 'desc')
                 ->order_by('a.created_at', 'desc')
                 ->limit($limit);

        if (!empty($order['period'])) {
            $_date = new DateTime('Asia/Tokyo');
            if ($order['period'] == 'day') {
                $whereFrom = 'UNIX_TIMESTAMP("' . $_date->format('Y-m-d') . '")';
                $whereTo   = 'UNIX_TIMESTAMP("' . $_date->format('Y-m-d 23:59:59') . '")';
            } else if ($order['period'] == 'month') {
                $whereFrom = 'UNIX_TIMESTAMP("' . $_date->format('Y-m-1') . '")';
                $whereTo   = 'UNIX_TIMESTAMP("' . $_date->format('Y-m-t 23:59:59') . '")';
            } else if ($order['period'] == 'year') {
                $whereFrom = 'UNIX_TIMESTAMP("' . $_date->format('Y-1-1') . '")';
                $whereTo   = 'UNIX_TIMESTAMP("' . $_date->format('Y-12-31 23:59:59') . '")';
            }

            $whereFrom = 'a.created_at >=' . $whereFrom;
            $whereTo   = 'a.created_at <=' . $whereTo;
            $this->db->where($whereFrom, null, false);
            $this->db->where($whereTo, null, false);
        }

        return $this->db->get()->result_array();
    }

    public function getFavorite($id)
    {
        $column = array(
            'id'          => 'a.id',
            'title'       => 'a.title',
            'created_at'  => 'FROM_UNIXTIME(a.created_at)',
            'read_num'    => 'COUNT(b.id)',
            'comment_num' => 'COUNT(c.id)',
            'user_name'   => 'd.name',
        );

        $this->db->select(toColumn($column), false)
                 ->from(toColumn('a', $this->_table))
                 ->join(toColumn('b', 'read'), 'a.id = b.report_id', 'left')
                 ->join(toColumn('c', 'comment'), 'a.id = c.report_id', 'left')
                 ->join(toColumn('d', 'user'), 'a.user_id = d.id', 'left')
                 ->join(toColumn('e', 'favorite_user'), 'a.user_id = e.user_id')
                 ->where('e.favorite_group_id', $id)
                 ->group_by('a.id')
                 ->order_by('created_at DESC')
                 ->limit(100);

        return $this->db->get()->result_array();
    }

    public function add($data)
    {
        //トランザクション開始
        $this->db->trans_start();

        $this->db->set($data);
        $this->db->set('created_at', 'UNIX_TIMESTAMP(NOW())', false);
        $this->db->insert($this->_table);
        $id = $this->db->insert_id();

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

}