<?php

class Login
{
    private $_CI = null;

    public function confirm()
    {
        $this->_CI = &get_instance();

        $this->_CI->load->library('auth');

        $this->_CI->load->helper('url');

        $this->_CI->load->config('auth', true);

        $authUser  = $this->_CI->config->config['auth']['auth_user'];
        $authAdmin = $this->_CI->config->config['auth']['auth_admin'];

        if (in_array($this->_CI->controllerName, $authAdmin)) {
            $this->_CI->load->model('Model_admin', 'admin', true);
            if (!$this->_CI->auth->hasId()
                || !$this->_CI->admin->exists($this->_CI->auth->getId())
            ) {
                redirect('/');
            }
        }


        if (!in_array($this->_CI->controllerName, $authUser)) {
            $this->_CI->load->model('Model_user', 'user', true);
            if (!$this->_CI->auth->hasId()
                || !$this->_CI->user->exists($this->_CI->auth->getId())
            ) {
                redirect('/');
            }
        }
    }
}