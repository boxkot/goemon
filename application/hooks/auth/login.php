<?php

class Login
{
    private $_CI = null;

    public function confirm()
    {
        $this->_CI = &get_instance();

        $this->_CI->load->library('session', 'Auth');

        $this->_CI->load->helper('url');

        $this->_CI->load->config('auth', true);

        $authUser  = $this->_CI->config->config['auth']['auth_user'];
        $authAdmin = $this->_CI->config->config['auth']['auth_admin'];

        if (false) {
            $this->_CI->load->library('auth', array('namespace' => 'Admin'));
            $this->_CI->load->model('Model_admin', 'admin', true);
            if (!$this->_CI->auth_admin->hasId()
                || !$this->_CI->admin->exists($this->_CI->auth_admin->getId())
            ) {
                redirect('/admin/');
            }

            $this->_CI->load->library('auth', array('namespace' => 'User'));
            $this->_CI->load->model('Model_user', 'user', true);

            if (!$this->_CI->auth->hasId()
                && !$this->_CI->user->exists($this->_CI->auth->getId())
            ) {
                redirect('/');
            }
        }
    }
}