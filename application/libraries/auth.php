<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class auth
{
    private $_CI = null;

    public function __construct()
    {
        $this->_CI = get_instance();
        $this->_CI->load->library('session', 'Auth');
    }

    public function hasId()
    {
      if (empty($this->_CI->session->id)) {
          return false;
      }

      return $this->_CI->session->id;
    }

    public function setId($id)
    {
        $this->_CI->session->id = $id;
        return $this;
    }

    public function getId()
    {
        return empty($this->_CI->session->id) ? null : $this->_CI->session->id;
    }

    public function clearId()
    {
        unset($this->_CI->session->id);
        return $this;
    }
}