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

}