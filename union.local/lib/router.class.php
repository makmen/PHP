<?php

class router {
    private $request;
    private $index = "_index.tpl";
    private $_404 = "_404.tpl";
    private $out = array();
    public $buffer = "";

    public function __construct($request) {
        $this->request = $request;
        $this->out["module"] = $this->request->module;
    }
    
    public function show() {
        if ($this->out["module"] != '') {
            if (!in_array($this->out["module"], array('dilspay', 'show')) && method_exists($this, $this->out["module"]) ) {
                // вызываем нужный шаблон
                call_user_func(array($this, $this->out["module"]));
                $this->buffer = $this->dilspay( DOC_ROOT . 'templates/' . $this->index );
            } else {
                $this->out['title'] = "Шифрование файлов";
                $this->buffer = $this->dilspay( DOC_ROOT . 'templates/' . $this->_404 );
            }
        } else {
            // пустой index
            $this->out['title'] = "Шифрование файлов - главная";
            $this->buffer = $this->dilspay( DOC_ROOT . 'templates/' . $this->index );
        }
    }
    
    private function dilspay($path) {
        ob_start();
        include($path);
        $content = ob_get_contents();
        ob_end_clean(); 
        
        return $content;
    }
    
    public function encrypt() {
        set_time_limit(0);
        ini_set('max_execution_time', 0);
        
        $this->out['title'] = "Шифрование файлов";
        $this->out['files'] = files::getFilesFromDir( DOC_ROOT . CRIPT_FILE_DIR );
        if (!empty($_POST)) {
            $this->out['key'] = trim($_POST['key']);
            if ($this->out['key'] == ''){
                $this->out['errs']['key'] = "Поле не должно быть пустым";
            } else if ( mb_strlen($this->out['key'], "UTF-8") < 10 ) {
                $this->out['errs']['key'] = "Ключ меньше 10 символов";
            } else if ( mb_strlen($this->out['key'], "UTF-8") > 30 ) {
                $this->out['errs']['key'] = "Ключ больше 30 символов";
            } else {
                
            }
            if (!isset( $this->out['errs'] )) {
                // переименовываем файлы
                files::renameFiles(DOC_ROOT . CRIPT_FILE_DIR, &$this->out['files']);
                $zip = sha1( time() );
                if ( !files::toArchive( DOC_ROOT . CRIPT_FILE_DIR, $zip . '.zip', $this->out['files'] ) ) {
                    $this->out['errs']['key'] = "Ошибка создания архива";
                } else {
                    if (is_dir( DOC_ROOT . CRIPT_FILE_READY )) {
                        files::clearDir( DOC_ROOT . CRIPT_FILE_READY );
                    } else {
                        mkdir( DOC_ROOT . CRIPT_FILE_READY );
                    }
                    $cryptKey = new cryptKey( $this->out['key'] );
                    $cryptKey->shifrKey();

                    $cryptText = new cryptText();
                    $cryptText->shifr( 
                        DOC_ROOT . CRIPT_FILE_DIR . DIRECTORY_SEPARATOR . $zip . '.zip', 
                        $cryptKey->getKeyShifr(),
                        $cryptKey->getShifrNameFiles()
                    );
  
                    $filesize = files::defineSizeFiles(
                        DOC_ROOT . CRIPT_FILE_READY,
                        files::getFilesFromDir( DOC_ROOT . CRIPT_FILE_READY ) 
                    );
                    $key = str_replace(array("/", "=", "+"), '', $cryptKey->getKeyShifr());
                    $write = $cryptText->cryptText( $key,  sha1($filesize), Data::$thirdData);   
                    $shifr = cryptKey::getKeyArray( $write );
                    $shifrNameFiles = $cryptKey->getShifrNameFiles();
                     for ($i = 0, $count = count($shifrNameFiles); $i < $count; $i++) {
                        rename(
                            DOC_ROOT . CRIPT_FILE_READY . DIRECTORY_SEPARATOR . $shifrNameFiles[$i] . '.pdf', 
                            DOC_ROOT . CRIPT_FILE_READY . DIRECTORY_SEPARATOR . $shifr[$i] . '.pdf'
                        );
                    }
                    unlink( DOC_ROOT . CRIPT_FILE_DIR . DIRECTORY_SEPARATOR . $zip . '.zip' );
                    $this->out['ok'] = 1;
                }
            }
        }
    }
    
    public function decode() {
        set_time_limit(0);
        ini_set('max_execution_time', 0);
        
        $this->out['title'] = "Расшифрование файлов";
        $this->out['files'] = files::getFilesFromDir( DOC_ROOT . CRIPT_FILE_READY );
        if (!empty($_POST)) {
            $this->out['key'] = trim($_POST['key']);
            if ($this->out['key'] == ''){
                $this->out['errs']['key'] = "Поле не должно быть пустым";
            } else if ( mb_strlen($this->out['key'], "UTF-8") < 10 ) {
                $this->out['errs']['key'] = "Ключ меньше 10 символов";
            } else if ( mb_strlen($this->out['key'], "UTF-8") > 30 ) {
                $this->out['errs']['key'] = "Ключ больше 30 символов";
            } else {
                
            }
            if (!isset( $this->out['errs'] )) {
                if (is_dir( DOC_ROOT . DECODE_FILE_DIR )) {
                    files::clearDir( DOC_ROOT . DECODE_FILE_DIR );
                } else {
                    mkdir( DOC_ROOT . DECODE_FILE_DIR );
                }

                $cryptKey = new cryptKey( $this->out['key'] );
                $cryptKey->shifrKey();
                
                $cryptText = new cryptText();
                
                $filesize = files::defineSizeFiles( 
                    DOC_ROOT . CRIPT_FILE_READY, $this->out['files']
                );
                $key = str_replace(array("/", "=", "+"), '', $cryptKey->getKeyShifr());
                $write = $cryptText->cryptText( $key,  sha1($filesize), Data::$thirdData);   
                $shifr = cryptKey::getKeyArray( $write );
                $shifrNameFiles = $cryptKey->getShifrNameFiles();
                for ($i = 0, $count = count($shifrNameFiles); $i < $count; $i++) {
                    if (file_exists( DOC_ROOT . CRIPT_FILE_READY . DIRECTORY_SEPARATOR . $shifr[$i] . '.pdf' )) {
                        rename(
                             DOC_ROOT . CRIPT_FILE_READY . DIRECTORY_SEPARATOR . $shifr[$i] . '.pdf',
                             DOC_ROOT . CRIPT_FILE_READY . DIRECTORY_SEPARATOR . $shifrNameFiles[$i] . '.pdf' 
                         );
                    }
                }
                $content = $cryptText->unshifr( 
                    $this->out['files'], 
                    $cryptKey->getKeyShifr(), 
                    $cryptKey->getShifrNameFiles()  
                );
                files::writeFile(
                    DOC_ROOT . DECODE_FILE_DIR . DIRECTORY_SEPARATOR . 'ok.zip', 
                    $content,  "w+"
                );
                $this->out['ok'] = 1;
            }
        }
    }

    public function contacts() {
        $this->out['title'] = "Шифрование файлов - наши контакты";
        if (!empty($_POST)) {
            foreach ($_POST as $k => $v) {
                $contacts[$k] = text::safe($v);
            }
            if (trim($contacts['name'])==''){
                $contacts['errs']['name'] = "Поле не должно быть пустым";
            }
            if (trim($contacts['email'])=='') { 
                $contacts['errs']['email']= "Поле не должно быть пустым";
            } else {
                if (!preg_match('/^[0-9a-z\._-]+@[0-9a-z\._-]+\.[a-z]{2}(m||fo||cal||z||t||g||v||u)?$/iu', $contacts['email'])) {
                    $contacts['errs']['email']= "Неверный адрес";
                }
            }
            if (trim($contacts['message'])==''){
                    $contacts['errs']['message'] = "Поле не должно быть пустым";
            }
            foreach ($contacts as $k => $v) {
                $this->out[$k] = $v; 
            }
            if (!isset($contacts['errs'])) {
                // отправляем сообщение
                $message = $this->dilspay( DOC_ROOT . 'templates/emailmessage.tpl');
                $mail = new mailer(); 
                $mail->CharSet="utf-8";
                $mail->ContentType="text/html";
                $mail->Encoding="quoted-printable";
                $mail->Subject='Обратная связь';
                $mail->Body = $message;
                $mail->AddAddress('vactt@mail.ru');
                $mess=$mail->Send();
                if ($mess) {
                    $this->out['sendSuccess'] = true;
                    $this->out['name'] = $this->out['email'] = $this->out['message'] = "";
                } else {
                    $this->out['errs']['sendError'] = "Письмо не отправлено, сайт перегружен, зайдите позже";
                }
            }
        }
    }
}