<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller
{
    public function index()
    {
        $this->load->library('auth');

        $this->load->model('Model_user', 'user', true);
        $this->load->model('Model_report', 'report', true);

        $id = $this->auth->getId();

        $this->view->newReport = $this->report->getNew($id);
        $this->view->profile   = $this->user->get($id);
    }

}