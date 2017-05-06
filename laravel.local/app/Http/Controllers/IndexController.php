<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Mail;
use Config;

use App\Libs\Number;

class IndexController extends Controller
{
    protected $out;

    public function index() {
        $this->out['header'] = "Главная страница";
      
        return view('index')->with('out', $this->out);
    }
    
    public function technology() {
        $this->out['header'] = "Технологии";
        return view('technology')->with('out', $this->out);
    }
    
    public function contacts() {
        $this->out['header'] = "Контакты";

        return view('contacts')->with('out', $this->out);
    }
    
    public function addcontacts(Request $request) {
        $this->out['header'] = "Контакты";
        $model = new Contact;
        $this->validate($request, $model->rules);
        $model->fill($request->all()); 
        Mail::send('emailcontact', 
            ['name' => $model->name, 'email' => $model->email, 'subject' => $model->message], 
            function ($message){
                $message->to(
                    Config::get('mail')['emailCompany'], 
                    Config::get('mail')['titleEmailCompany']
                );
            }
        );
        $this->getMainError(true); // не понятно как отлавливать ошибки

        return view('contacts')->with('out', $this->out);
    }
    
    public function getMainError($success, $error = true) {
        if ($success) {
            $this->out['success'] = $error; 
        } else {
            $this->out['errmessage'] = $error;
        }
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
        $font = Config::get('filesystems')['public']['root'].DIRECTORY_SEPARATOR.'font'.DIRECTORY_SEPARATOR;
        for($i = 1; $i <= $limitFonts; $i++) {
            $symbol_fonts[] = $font."load" . $i . ".ttf";
        }
        $text = Number::getNumberCaptaha(5);
        $_SESSION["captcha"] = $text;
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
