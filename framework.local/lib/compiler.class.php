<?php

class compiler {
    private static $instance;
    public $request;

    public $tplDir='templates/front/';
    public $cmpDir='compiled/';
    public $mdDir='modules/';
    public $index = '_index.tpl';
    
    /* bool paremetr to recompile templates */
    public $recompile;
    
    //public $module = array();

    private $tplTagOpen = '{';
    private $tplTagClose = '}';
    public $vars = array();
    
    /*
     * три параметра максимум могут передаваться в модуль 
     * module
     * template
     * id
     */
    private $limit= 3;
    
    /*public function getMdDir() {
        return $this->mdDir;
    }*/
    
    private function __construct($request) {
        $this->request = $request;
        $this->vars['module'] = $this->vars['parentmodule'] = $request->module;
        $this->vars['template'] = $this->vars['parenttemplate'] = $request->template;
        $this->vars['id'] = $this->vars['parentid'] = $request->id;
    }
    
    public function loadModule($first = false) {
        // greate module if it needs
        if ($this->vars['parentmodule'] != '') {
            if (is_file(DOC_ROOT . $this->mdDir . $this->vars['parentmodule'] . '/' . $this->vars['parentmodule'] . '.class.php')) {
                //$this->module[] = new $this->vars['parentmodule']();
                //$this->vars = end($this->module)->getOut();
                $module = new $this->vars['parentmodule']();
                $this->vars = $module->getOut();
                if ($first) {
                    $this->vars['template'] = $this->vars['parenttemplate'];
                }
            } else {
                $this->index = '_404.tpl';
                $this->vars['modulenotfound'] = true;
            }
        }
    }
    
    public static function getInstance($request = null) {
        if (self::$instance === null)
        {
            self::$instance = new compiler($request);
        }

        return self::$instance;
    }

    public static function createFromTemplate($template, $out) {
        $instanse = self::$instance;
        $instanse->vars = $out;
        $pathToCompiled = $instanse->cmpDir . $template;
        if (!$instanse->recompile && is_file($instanse->cmpDir . $template)) {
            $content = file_get_contents($pathToCompiled);
        } else {
            $content = $instanse->compile($template);
            $instanse->compilingSave($content, $pathToCompiled);
        }
        $content = $instanse->getContents($instanse, $content, $pathToCompiled);
        
        return $content;
    }
    
    public function setStrategy() {
        $compiler = null;
        if (!$this->request->isAjax) {
            $compiler = new compilermodule(); 
        } else {
            $compiler = new compilerajax(); 
        }
        
        return $compiler;
    }
    
    public function build() {
        $content = "";
        try {
            /*if (!$this->request->isAjax) { // если не AJAX
                $pathToCompiled = ($this->vars['module'] != '' && !isset($this->vars['modulenotfound'])) ?
                    ((!isset($this->vars['noAccess'])) ? 
                        ($this->cmpDir . $this->vars['module'] . '/_' . $this->vars['template']. '.tpl') :
                        ($this->cmpDir . $this->vars['module'] . '/_noAccess_' . $this->vars['template']. '.tpl')) :
                    $this->cmpDir . $this->index;
            } else {
                // ajax содержит модуль который уже запущен и отработан
                $this->tplDir = $this->tplDirAjax;
                $pathToCompiled = (!isset($this->vars['noAccess'])) ? 
                    ($this->cmpDir . $this->vars['module'] . '/_ajax_' . $this->vars['template']. '.tpl') :
                    ($this->cmpDir . $this->vars['module'] . '/_ajax_noAccess_' . $this->vars['template']. '.tpl');  
            }*/
            
            $compiler = $this->setStrategy();
            $content = $compiler->startCompiling();

            /*if (!$this->recompile && is_file($pathToCompiled)) {
                $content = file_get_contents($pathToCompiled);
            } else {
                if (!$this->request->isAjax) {
                    $content = $this->compile($this->index);
                } else {
                    $content = $this->compile($this->vars['parentmodule'] . '/_' . $this->vars['parenttemplate'] . '.tpl' );
                } 
                if ($content != "") {
                    $this->compilingSave($content, $pathToCompiled);
                }
            }
            if ($content != "") {
                $content = $this->getContents($this, $content, $pathToCompiled);
            }*/
        } catch (Exception $ex) {
            $content = $ex->getMessage();
        }

        echo $content;
    }

    public function getContents($instance, $content, $pathToCompiled) {
        $instance->vars['_GET'] = $_GET;
        $instance->vars['_REQUEST'] = $_REQUEST;   
        $instance->vars['_POST'] = $_POST;
        $instance->vars['_SESSION'] = $_SESSION;
        $instance->vars['_SERVER'] = $_SERVER;
        
        ob_start();
        include($pathToCompiled);
        $content = ob_get_contents();
        ob_end_clean();   
        
        return $content;
    }
    
    public function compile($tmpl) {
        $pathTemplate = DOC_ROOT . $this->tplDir . $tmpl;
        if (is_file($pathTemplate)) {
            $content = file_get_contents($pathTemplate);
            $content = $this->compiling($content);
        } else {
            throw new Exception("Parce Error. File not exists " . $this->tplDir . $tmpl);
        }
        
        return $content;
    }
      
    public function compilingSave($content, $pathCompiled) {
        if ($this->vars['module'] != '' &&  !isset($this->vars['modulenotfound'])) {
            if (!is_dir($this->cmpDir . $this->vars['module'] )) {
                @mkdir($this->cmpDir . $this->vars['module']);
            }
        }
        $handle = fopen($pathCompiled, "w");
        fwrite($handle, $content);
        fclose($handle);
    }

    public function compiling($content) {
        $conditionQueue = array();    
        preg_match_all('/'.$this->tplTagOpen.'([^ ^'.$this->tplTagClose.']+)( ([^'.$this->tplTagClose.']+))?'.$this->tplTagClose.'/im', $content, $tmpl_tags, PREG_SET_ORDER);   
        foreach($tmpl_tags as $key=>$val) {
            $rplcmnt='';
            switch($val[1]) {
                case 'if':
                    $rplcmnt = $this->parceVars($val[2]);  
                    $conditionQueue[0][]='('.$rplcmnt.')';
                    $conditionQueue[1][]='if';  
                    $rplcmnt="if ($rplcmnt) {";
                    break;
                case 'elseif':
                    $rplcmnt = $this->parceVars($val[2]);
                    $conditionQueue[0][count($conditionQueue[0])-1]='!('.$conditionQueue[0][count($conditionQueue[0])-1].')';
                    $conditionQueue[0][]='('.$rplcmnt.')';
                    $conditionQueue[1][]='elseif';
                    $rplcmnt="} elseif ($rplcmnt) {";
                    break;
                case 'else':
                    $conditionQueue[0][count($conditionQueue[0])-1]='!('.$conditionQueue[0][count($conditionQueue[0])-1].')';
                    $rplcmnt=" } else { ";
                    break;
                case '/if':
                    do {
                        $cnd=@array_pop($conditionQueue[1]);
                        @array_pop($conditionQueue[0]);
                    } while ($cnd=='elseif');
                    $rplcmnt=" } ";
                    break;   
                case 'uri':
                    $params=trim($this->parceVars($val[2]));      
                    preg_match_all('/\'(.+)\'/i',$params, $run, PREG_PATTERN_ORDER);  
                    $content = str_replace($val[0],SERVER_ROOT.$run[1][0],$content);  
                break; 
                case 'url':
                    $url = preg_split('/\s+/', trim($val[2]));
                    foreach($url as $k=>$v) {
                        if (strpos($v, '$') !== false) {// looking for $
                            $url[$k] = $this->vars[substr($v, 1)];
                        }
                    }
                    $url = implode("/", $url);
                    $url = ( $url != "/" ) ? SERVER_ROOT . $url : SERVER_ROOT;
                    $content = str_replace($val[0],$url,$content);
                break; 
                case 'foreach':
                    preg_match('/foreach (\$.+) as \$([\w\d\_]+)=>\$([\w\d\_]+)/',$val[0],$from);
                    $cml_from = $this->parceVars($from[1]);
                    $rplcmnt='if (is_array('.$cml_from.') && count ('.$cml_from.')>0) {reset('.$cml_from.'); while (list('.$this->parceVars("$".$from[2]).', '.$this->parceVars("$".$from[3]).') = each('.$cml_from.')) { '; 
                    break;
                case 'foreachelse':
                    $rplcmnt='} } else { {';
                    break;
                case '/foreach':
                    $rplcmnt=" } } ";
                    break;
                case 'include':
                    $params = trim($this->parceVars($val[2])); 
                    preg_match_all('/\'(.+)\'/i',$params, $run, PREG_PATTERN_ORDER);
                    $params = $this->compile($run[1][0]);
                    $content = str_replace($val[0], $params, $content);
                    break;
                case 'run':
                    $url = preg_split('/\s+/', trim($val[2]));
                    $current = $this->defineParentModule($url);
                    if ($this->vars['module'] != '' ||
                            ($this->vars['module'] == '' && $this->vars['parentmodule'] != '')
                        ) {
                        if (!$current) {
                            $this->loadModule();
                            $params = $this->compile($this->vars['parentmodule'] . '/_' . $this->vars['parenttemplate'] . '.tpl' );
                            $php = '<? $this->vars["parentmodule"] = ' . $this->vars['parentmodule'] . '; ';
                            $php .= '$this->vars["parenttemplate"] = ' . $this->vars['parenttemplate'] . '; ';
                            $php .= '$this->loadModule(); ?>';
                            $params = $php . $params;
                        } else if ($this->vars['module'] != ''){
                            // выполнение модуля по default
                            // noAccess может быть только для модуля по default
                            $params = (!isset($this->vars['noAccess'])) ? 
                                    $this->compile($this->vars['module'] . '/_' . $this->vars['template'] . '.tpl') :
                                    $this->compile('_noAccess.tpl');
                        }
                        $content = str_replace($val[0], $params, $content);
                    }
                    break;
                default:
                    $rplcmnt=(preg_match('/\$[\w\d\_]+=/',$val[1])?'':'echo '). $this->parceVars($val[1].';');  
                    break;
            }
            $content = preg_replace('/'.preg_quote($val[0],"/").'/im','<? '.$rplcmnt.' ?>',$content);      
        }
       
        return $content;
    }
    
    private function defineParentModule($url) {
        $vars = array();
        $parent = 'parent';
        $array = array("module", "template", "id");
        $count = (count($url) < $this->limit) ? count($url) : $this->limit;
        // это модуль по умолчанию?
        for ($i = 0, $j = 0; $i < $count; $i++) {
            $pos = strpos($url[$i], '$'); // looking for $
            if ($pos !== false) {
                ++$j;
                $vars[$parent.$array[$i]] = $this->vars[$array[$i]];   
            } else {
                $vars[$parent.$array[$i]] = $url[$i];
            }
        }
        if ($j == $count) {
            return true; // да, не меняем parents
        }
        foreach ($vars as $k => $v) {
            $this->vars[$k] = $v;          
        }
        
        return false;
    }
    
    private function parceVars($vars) {
        if(!is_array($vars)) {
            $vars=preg_replace('/\'?\"?(\$([\w\d\_]+))\'?\"?/','compiler::getInstance()->vars["\\2"]', $vars);
        } else {
            if(count($vars)>0) {
                foreach($vars as $key=>$val) {
                    $vars[$key]=preg_replace('/\'?\"?(\$([\w\d\_]+))\'?\"?/','compiler::getInstance()->vars["\\2"]',$val);
                }
                $vars=implode(' ',$vars);
            }
        }
        
        return $vars;
    }

	
}