<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends CI_Controller
{
    private $_formElements = array(
        'login_id',
        'login_pass',
    );

    private $_formElementsAdd = array(
        'mail',
        'auth_id',
    );

    public function index()
    {
        //ライブラリ読み込み
        $this->load->library('auth', array('namespace' => 'Admin'));
        $this->load->library('validate');

        //ヘルパー読み込み
        $this->load->helper('url');
        $this->load->helper('form_operate');

        if ($this->auth->getId()) {
            redirect('/admin/top/');
        }

        $data = getForm($this->_formElements);

        if (isPost()) {
            if ($this->validate->isValid($data)) {
                $this->load->model('Model_admin', 'admin', true);
                if ($this->admin->loginRecognized($data)) {
                    $id = $this->admin->getId($data['login_id']);
                    $this->auth->setId($id);

                    redirect('/admin/top/');
                }
            }
        }

        $this->view->data = $data;
    }

    public function top()
    {
        $this->load->library('auth', array('namespace' => 'Admin'));
    }

    public function add()
    {
        $this->load->library('auth', array('namespace' => 'Admin'));
        $this->load->library('validate');

        $this->load->model('Model_auth', 'model_auth', true);

        $this->load->helper('form_operate');

        $data = getForm($this->_formElementsAdd);

        $this->view->auth = $this->model_auth->getAll();
    }

    public function edit()
    {
        $this->load->library('auth', array('namespace' => 'Admin'));
        $this->load->model('Model_admin', 'admin', true);
        $this->load->model('Model_auth', 'model_auth', true);

        $this->load->helper('form_operate');

        $search = array(
            'id' => $this->auth->getId(),
        );

        $this->view->data = $this->admin->getAll($search);
        $this->view->auth = $this->model_auth->getAll();
        $this->view->form = getForm($this->_formElementsAdd);
    }

}
