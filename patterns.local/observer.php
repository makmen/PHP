<?php
    header('Content-Type: text/html; charset=UTF-8');
    
    interface Observable {
        public function attach (Observer $observer);
        public function detach (Observer $observer);
        public function  notify();
    }

    class Login implements Observable {
        const LOGIN_USER_UNKNOWN = 1;
        const LOGIN_WRONG_USER = 2;
        const LOGIN_ACCESS = 3;
        
        private $status;
        private $observers = array();

        public function attach(Observer $observer) {
            $this->observers[] = $observer;
        }
        
        public function detach(Observer $observer) {
            $newobservers = array();
            foreach ($this->observers as $obs) {
                if ($obs !== $observer) {
                    $newobservers[] = $obs;
                }
            }
            $this->observers = $newobservers;
        }
        
        public function notify() {
            foreach ($this->observers as $obs) {
                $obs->update($this);
            }
        }
        
        public function habdleLogin($user, $pass, $ip) {
            switch(rand(1,3)) {
                case 1:
                    $this->setStatus(self::LOGIN_USER_UNKNOWN, $user, $ip);
                    $ret = false;
                    break;
                case 2:
                    $this->setStatus(self::LOGIN_WRONG_USER, $user, $ip);
                    $ret = false;
                    break;
                case 3:
                    $this->setStatus(self::LOGIN_ACCESS, $user, $ip);
                    $ret = true;
                    break;
            }
            $this->notify();
            return $ret;
        }
        
        private function setStatus($status, $user, $ip) {
            $this->status = array($status, $user, $ip);
        }
        
        public function getStatus() {
            return $this->status;
        }
                
    }

    interface Observer {
        function update (Observable $observable);
    }
    
    /*abstract class LoginObserver implements Observer {
        private $login;
        
        function __construct($login) {
            $this->login = $login;
            $login->attach( $this );
        }
        
        function update(Observable $observable) {
            if ($observable === $this->login) {
                $this->doUpdate($observable);
            }
        }
        abstract function doUpdate(Login $login);
    }
            
    class SecurityMonitor extends LoginObserver {
        function doUpdate (Login $login) {
            $status = $login->getStatus();
            echo "почту сис админу " . $status[0] . "<br />" ;                
        }
    }
    class GeneralLogger extends LoginObserver {
        function doUpdate (Login $login) {
            $status = $login->getStatus();
            echo "регистрация в журнале " . $status[0] . "<br />" ;               
        }
    }
    class PartnerTool extends LoginObserver {
        function doUpdate (Login $login) {
            $status = $login->getStatus();
            echo "хрень какая-то " . $status[0] . "<br />" ;                
        }
    }*/
    
    class SecurityMonitor implements Observer {
        function update (Observable $observable) {
            $status = $observable->getStatus();
            echo "почту сис админу " . $status[0] . "<br />" ;                
        }
    }
    class GeneralLogger implements Observer {
        function update (Observable $observable) {
            $status = $observable->getStatus();
            echo "регистрация в журнале " . $status[0] . "<br />" ;                  
        }
    }
    class PartnerTool implements Observer {
        function update (Observable $observable) {
            $status = $observable->getStatus();
            echo "хрень какая-то " . $status[0] . "<br />" ;                
        }
    }       
    
    $login = new Login();
    $login->attach(new SecurityMonitor());
    $login->attach(new GeneralLogger());
    $login->attach(new PartnerTool());
    //$secureMonitor = new SecurityMonitor($login);
    //$generalLogger = new GeneralLogger($login);
    //$partnerTool = new PartnerTool($login);
    $login->habdleLogin("user", "pass", "152.36.23.31");
    $login->habdleLogin("colac", "pass", "152.36.23.31");
    $login->habdleLogin("batton", "pass", "152.36.23.31");

