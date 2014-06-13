<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class index extends CI_Controller
{
    private $_formElements = array(
        'login_id',
        'login_pass',
    );

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->library('auth');
        $this->load->library('validate');

        $this->load->helper('url');
        $this->load->helper('form_operate');

        if ($this->auth->getId()) {
            redirect('/user/index/');
        }

        $data = getForm($this->_formElements);

        if (isPost()) {
            if ($this->validate->isValid($data)) {
                $this->load->model('Model_user', 'user', true);
                if ($this->user->loginRecognized($data)) {
                    $id = $this->user->getId($data['login_id']);
                    $this->auth->setId($id);

                    redirect('/user/index/');
                }
            }
        }

        $this->view->data = $data;
    }
}