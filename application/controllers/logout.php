<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class logout extends CI_Controller
{
    public function index()
    {
        $this->view->setRenderLayout(false);
        $this->view->setRenderView(false);

        $this->load->library('session');
        $this->session->destroy();

        $this->load->helper('url');

        redirect('/');
    }
}
