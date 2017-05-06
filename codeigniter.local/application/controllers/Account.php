<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
    private $out = array();
    
    public function index() {
        $this->add();
    }
    
    public function add() {
        if (isset($this->session->userdata['login']) && !isset($this->out['mode'])) {
            header('Location:' . BASE_URL . 'account/edit');
        }
        if (!isset($this->out['mode'])) {
            $this->out['mode'] = 'add';
            $this->load->model('account/Register_model');
        }
        if (!empty($_POST)) {
            $this->Register_model->checkData($this->out['mode']);
            $this->Register_model->setUser();
        }
        $this->out = array_merge($this->out, $this->Register_model->getData());
        $this->out['content_tpl'] = 'account/add_tpl';
        $this->load->view('main_tpl', $this->out);
    }
    
    public function edit() {
        if (!isset($this->session->userdata['login'])) {
            header('Location:' . BASE_URL . 'account/add');
        }
        $this->out['mode'] = 'edit';
        $this->load->model('account/Register_model');
        $this->out = array_merge($this->out, $this->Register_model->getUser($this->session->userdata['login']));
        $this->add();
    }
    
    public function forget() {
        if (isset($this->session->userdata['login'])) {
            header('Location:' . BASE_URL);
        }
        
        $this->load->model('account/Forget_model');
        if (!empty($_POST)) {
            $this->Forget_model->checkData();
            $this->Forget_model->formLink();
            $this->Forget_model->sendMessage();
        }
        $this->out = array_merge($this->out, $this->Forget_model->getData());
        $this->out['content_tpl'] = 'account/forget_tpl';
        $this->load->view('main_tpl', $this->out);
    }

    public function signin() {
        $this->out['access'] = false;
        if (!empty($_POST)) {
            $this->load->model('account/Signin_model');
            $this->Signin_model->checkAccess();
            $this->out = $this->Signin_model->getData();
            if ($this->out['access']) {
                $this->session->set_userdata($this->out['result']);
            }
        }
        echo $this->out['access'];
    }

    public function signout() {
        $this->session->sess_destroy();
        header('Location:' . BASE_URL);
    }
    
    public function makecaptcha() {
        header("Content-type: image/png");
        
        $image_x = 200;
        $image_y = 50;
        $symbol_min_angle = -45;
        $symbol_max_angle = 45;  
        $symbol_min_size = 18;
        $symbol_max_size = 20;
        
        $limitFonts = 5;
        $symbol_fonts = array();
        $font = DOCROOT.'font'.DIRECTORY_SEPARATOR;
        for($i = 1; $i <= $limitFonts; $i++) {
            $symbol_fonts[] = $font."load" . $i . ".ttf";
        }
        $this->load->library('Number');
        $text = Number::getNumberCaptaha(5);
        $this->session->set_userdata(array("captcha"=>$text));

        $im = imagecreatetruecolor($image_x, $image_y);
        $backgroundcolor = imagecolorallocate( $im, 255 , 255 , 255 );
        imagefill($im, 0, 0, $backgroundcolor);
        // Текст
        $sx=0;
        $step=round($image_x/(strlen($text)+2));
        for($i=0;$i<strlen($text);$i++) {
            $symb = $text[$i];  
            $sx += $step+(rand(-round($step/5),round($step/5)));
            $sy = $image_y-round($image_y/3)+rand(-round($image_y/5),round($image_y/5));
            $sa = rand($symbol_min_angle,$symbol_max_angle);
            $ss = rand($symbol_min_size,$symbol_max_size);
            $sf = $symbol_fonts[rand(0, $limitFonts - 1)];
            $sc = imagecolorallocate($im, 50 + rand(-50,50), 50 + rand(-50,50), 50 + rand(-50,50));
            imagettftext($im, $ss, $sa, $sx, $sy, $sc, $sf, $symb);
        }
        // Линии
        $lines_count = rand(5, 8);
        for ($i=0;$i<$lines_count;$i++) {
            $st_x = rand(0,$image_x);
            $st_y = rand(0,$image_y);
            $en_x = rand(0,$image_x);
            $en_y = rand(0,$image_y);
            $lc = imagecolorallocate($im, 100 + rand(-100,100), 100 + rand(-100,100), 100 + rand(-100,100));
            //цвет
            imageline($im, $st_x, $st_y, $en_x, $en_y, $lc);
        }
        imagepng($im);
        imagedestroy($im);
    }
    
    
}
