<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_user extends CI_Controller
{
    private $_formElements = array(
        'mail',
    );

    private $_formElementsEdit = array(
        'grade_id',
        'unit_id',
    );

    public function add()
    {
        $this->load->library('auth', array('namespace' => 'Admin'));
        $this->load->model('Model_admin', 'admin', true);

        //ヘルパー読み込み
        $this->load->helper('url');
        $this->load->helper('form_operate');

        $data = getForm($this->_formElements);

        if (isPost()) {
            $this->load->model('Model_interim_user', 'interim_user', true);
            foreach ($data['mail'] as $mail) {
                $this->interim_user->add($data);
            }
        }

        $this->view->data = $data;
    }

    public function edit()
    {
        $this->load->library('auth', array('namespace' => 'Admin'));
        $this->load->model('Model_user', 'user', true);
        $this->load->model('Model_grade', 'grade', true);
        $this->load->model('Model_unit', 'unit', true);
        $this->load->model('Model_admin', 'admin', true);

        //ヘルパー読み込み
        $this->load->helper('form_operate');

        $form = getForm($this->_formElementsEdit);

        $this->view->data  = $this->user->getAll(array());
        $this->view->grade = $this->grade->getAll();
        $this->view->unit  = $this->unit->getAll();
        $this->view->form  = $form;
    }

}