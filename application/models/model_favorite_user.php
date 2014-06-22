<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_favorite_user extends CI_Model
{
    private $_table = 'favorite_user';

    public function getList($favoriteGroupId)
    {
        $column = array(
            'id'      => 'a.id',
            'user_id' => 'b.id',
            'name'    => 'b.name'
        );

        $this->db->select(toColumn($column))
                 ->from(toColumn('a', $this->_table))
                 ->join(toColumn('b', 'user'), 'a.user_id = b.id', 'left')
                 ->where('a.favorite_group_id', $favoriteGroupId);

        return $this->db->get()->result_array();
    }

    public function add($data)
    {
       //トランザクション開始
        $this->db->trans_start();

        $this->db->insert($this->_table, $data);
        $id = $this->db->insert_id();

        $this->db->trans_complete();

        if ($this->db->trans_status()) {
            return $id;
        }

        return false;
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->_table);
    }

}