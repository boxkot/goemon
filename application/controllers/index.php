<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class index extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->library('validate');

        $test = array(
            'login_id'   => 'aaa',
            'login_pass' => '',
        );

        if ($this->validate->isValid($test)) {
            echo 'good';
        }

        var_dump($this->validate->getError());
    }
}