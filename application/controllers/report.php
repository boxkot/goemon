<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class report extends CI_Controller
{
    private $_formElements = array(
        'title',
        'content',
    );

    public function myList()
    {
        //ライブラリ読み込み
        $this->load->library('auth');

        //モデル読み込み
        $this->load->model('Model_report', 'report', true);

        $this->view->report = $this->report->getMyReport($this->auth->getId());
    }

    public function view()
    {
        //モデル読み込み
        $this->load->model('Model_report', 'report', true);
        $this->load->model('Model_read', 'read', true);
        $this->load->model('Model_comment', 'comment', true);

        $id = $this->input->get('id');
        if ($id === false) {
            $this->load->helper('url');
            redirect('/user/');
        }

        $this->view->report     = $this->report->getDetail($id);
        $this->view->readUser   = $this->read->getUser($id);
        $this->view->readNum    = $this->read->getNum($id);
        $this->view->comment    = $this->comment->getComment($id);
        $this->view->commentNum = $this->comment->getNum($id);
    }

    public function write()
    {
        //ライブラリ読み込み
        $this->load->library('auth');
        $this->load->library('validate');

        //ヘルパー読み込み
        $this->load->helper('url');
        $this->load->helper('form_operate');

        $data = getForm($this->_formElements);

        if (isPost()) {
            $data['user_id'] = $this->auth->getId();
            if ($this->validate->isValid($data)) {
                $this->load->model('Model_report', 'report', true);
                if ($this->report->add($data)) {
                }
            }
        }

        $this->view->data = $data;
    }

}