<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_user extends CI_Model
{
    private $_table = 'user';

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

    public function getId($id)
    {
        $this->db->select('id')
              ->from($this->_table)
              ->where('login_id', $id);

        $data = $this->db->get()->row();
        return empty($data) ? false : $data->id;
    }

    public function loginRecognized($data)
    {
        $this->db->select()
                 ->from($this->_table)
                 ->where('login_id', $data['login_id'])
                 ->where('login_pass', $data['login_pass']);

        return $this->db->get()->num_rows() === 1;
    }

    public function getList($id)
    {
        $column = array(
            'id'         => 'a.id',
            'name'       => 'a.name',
            'grade_id'   => 'b.id',
            'grade_name' => 'b.name',
            'unit_id'    => 'c.id',
            'unit_name'  => 'c.name',
        );

        $this->db->select(toColumn($column))
            ->from(toColumn('a', $this->_table))
            ->join(toColumn('b', 'grade'), 'a.grade_id = b.id', 'left')
            ->join(toColumn('c', 'unit'), 'a.unit_id = c.id', 'left')
            ->where('a.id !=', $id);

        return $this->db->get()->result_array();
    }

    public function getAll($search)
    {
        $column = array(
            'id'         => 'a.id',
            'name'       => 'a.name',
            'grade_id'   => 'b.id',
            'grade_name' => 'b.name',
            'unit_id'    => 'c.id',
            'unit_name'  => 'c.name',
        );

        $this->db->select(toColumn($column))
            ->from(toColumn('a', $this->_table))
            ->join(toColumn('b', 'grade'), 'a.grade_id = b.id', 'left')
            ->join(toColumn('c', 'unit'), 'a.unit_id = c.id', 'left')
            ->limit(100);

        if (!empty($search['grade_id'])) {
            $this->db->where('b.id', $search['grade_id']);
        }

        if (!empty($search['unit_id'])) {
            $this->db->where('c.id', $search['unit_id']);
        }

        return $this->db->get()->result_array();
    }

    public function edit($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update($this->_table, $data);
    }

}