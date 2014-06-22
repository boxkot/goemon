<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_admin extends CI_Model
{
    private $_table = 'admin';

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

    public function getAll($search = array())
    {
        $column = array(
            'id'      => 'a.id',
            'name'    => 'a.name',
            'auth_id' => 'a.auth_id',
        );

        $this->db->select()
            ->from(toColumn('a', $this->_table))
            ->join(toColumn('b', 'auth'), 'a.auth_id = b.id', 'left')
            ->limit(100)
            ->order_by('a.id');

        if (!empty($search['id'])) {
             $this->db->where('a.id !=', $search['id']);
        }

        if (!empty($search['auth_strong'])) {
             $this->db->where('b.strong >', $search['auth_strong']);
        }

        return $this->db->get()->result_array();
    }

}