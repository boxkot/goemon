<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller
{
    public function index()
    {
        $this->load->library('auth', array('namespace' => 'User'));

        $this->load->model('Model_user', 'user', true);
        $this->load->model('Model_report', 'report', true);
        $this->load->model('Model_favorite_group', 'favorite_group', true);

        $id = $this->auth->getId();

        $this->view->newReport = $this->report->getNew($id);
        $this->view->profile   = $this->user->get($id);
        $this->view->favorite  = $this->favorite_group->getList($this->auth->getId());
    }

}