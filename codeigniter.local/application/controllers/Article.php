<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {
    private $out = array();
    
    public function index() {
        $this->out['content_tpl'] = 'article/index_tpl';
        $this->load->view('main_tpl', $this->out);
    }

    public function support() {
        $this->out['content_tpl'] = 'article/support_tpl';
        $this->load->view('main_tpl', $this->out);
    }

    public function about() {
        $this->out['content_tpl'] = 'article/about_tpl';
        $this->load->view('main_tpl', $this->out);
    }
    
    public function contact() {
        $this->load->model('article/Contact_model');
        if (!empty($_POST)) {
            $this->Contact_model->checkData();
            $this->Contact_model->sendMessage();
        }
        $this->out = $this->Contact_model->getData();
        $this->out['content_tpl'] = 'article/contact_tpl';
        $this->load->view('main_tpl', $this->out);
    }
    
}
