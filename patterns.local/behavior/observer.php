<?php

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
    
    class SecurityMonitor implements Observer {
        function update (Observable $observable) {
            $status = $observable->getStatus();
            echo "Send email to admin " . $status[0] . "<br />" ;                
        }
    }
    class GeneralLogger implements Observer {
        function update (Observable $observable) {
            $status = $observable->getStatus();
            echo "Log in " . $status[0] . "<br />" ;                  
        }
    }
    class PartnerTool implements Observer {
        function update (Observable $observable) {
            $status = $observable->getStatus();
            echo "other option" . $status[0] . "<br />" ;                
        }
    }       
    
    $login = new Login();
    $login->attach(new SecurityMonitor());
    $login->attach(new GeneralLogger());
    $login->attach(new PartnerTool());
    $login->habdleLogin("user", "pass", "152.36.23.31");
    $login->habdleLogin("colac", "pass", "152.36.23.31");
    $login->habdleLogin("batton", "pass", "152.36.23.31");
    $login->habdleLogin("kwar", "pass", "152.36.23.31");
