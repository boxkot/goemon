<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class report extends CI_Controller
{
    private $_formElements = array(
        'title',
        'content',
    );

    public function all_list()
    {
        //ライブラリ読み込み
        $this->load->library('auth', array('namespace' => 'User'));

        //モデル読み込み
        $this->load->model('Model_report', 'report', true);

        $this->view->data = $this->report->getAll($this->auth->getId());
    }

    public function my_list()
    {
        //ライブラリ読み込み
        $this->load->library('auth', array('namespace' => 'User'));

        //モデル読み込み
        $this->load->model('Model_report', 'report', true);

        $this->view->data = $this->report->getMyReport($this->auth->getId());
    }

    public function view()
    {
        //ライブラリ読み込み
        $this->load->library('auth', array('namespace' => 'User'));

        //モデル読み込み
        $this->load->model('Model_report', 'report', true);
        $this->load->model('Model_read', 'read', true);
        $this->load->model('Model_comment', 'comment', true);

        //ヘルパー読み込み
        $this->load->helper('form_operate');

        $id = $this->input->get('id');
        if ($id === false || $this->report->exists($id) === false) {
            $this->load->helper('url');
            redirect('/user/');
        }

        if (isPost()) {
            $data = array(
                'user_id'   => $this->auth->getId(),
                'report_id' => $id,
                'content'   => $this->input->post('content'),
            );

            $this->comment->add($data);
        }

        $detail = $this->report->getDetail($id);
        if ($detail['user_id'] != $this->auth->getId()) {
            $data = array(
                'user_id'   => $this->auth->getId(),
                'report_id' => $id,
            );

            if (!$this->read->exists($data)) {
                $this->read->add($data);
            }
        }

        $this->view->id         = $id;
        $this->view->report     = $detail;
        $this->view->readUser   = $this->read->getUser($id);
        $this->view->readNum    = $this->read->getNum($id);
        $this->view->comment    = $this->comment->getComment($id);
        $this->view->commentNum = $this->comment->getNum($id);
    }

    public function write()
    {
        //ライブラリ読み込み
        $this->load->library('auth', array('namespace' => 'User'));
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

    public function ranking()
    {
        //ライブラリ読み込み
        $this->load->model('Model_report', 'report', true);

        //ヘルパー読み込み
        $this->load->helper('form_operate');

        if (isPost()) {
        }

        $this->view->data = $this->report->getRanking(array('period' => 'day'));
    }

    public function favorite()
    {
        $this->load->model('Model_report', 'report', true);
        $this->load->model('Model_favorite_group', 'favorite_group', true);
        $this->load->helper('url');

        $id = $this->input->get('id');
        if ($id === false && $this->favorite_group->exists($id) === false) {
            redirect('/user/index/');
        }

        $this->view->data = $this->report->getFavorite($id);
    }

}