<?php
    header('Content-Type: text/html; charset=UTF-8');
    
    abstract class Command {
        abstract public function execute(CommandContext $context);
    }
    
    class LoginCommand extends Command {
        function execute(CommandContext $context) {
            $manager = new Registry();
            $user = $manager->login("", $context->get( 'pass' ));
            if (is_null($user)) {
                $context->setError($manager->getError());
                print_r($context->getError());
                return false;
            }
            $context->addParam("user", $user);
            print_r("вошли");
            return true;
        }
        
    }
    
    class Registry {
        private $error = "";
        function login($user, $pass) {
            if ($user == "" || $pass = "") {
                $this->error = "Не верный логин";
                return null;
            } else {
                return new User($user, $pass);
            }
        } 
        function getError() {
            return $this->error;
        }
    }
    
    class User {
        private $user;
        private $pass;
        function __construct($user, $pass) {
            $this->user = $user;
            $this->pass = $pass;
        }
    }
    
    class CommandContext {
        private $params = array();
        private $error = "";
        function __construct() {
            //$this->params[] = $_REQUEST;
            $this->params['username'] = 'username';
            $this->params['pass'] = 'password';
        }
        function addParam($key, $val) {
            $this->params[$key] = $val;
        }
        function get ($key) {
            return $this->params[$key];
        }
        function setError ($error) {
            $this->error = $error;
        }
        function getError () {
            return $this->error;
        }
    }
    
    $commandContext = new CommandContext();
    $loginCommand = new LoginCommand();
    $loginCommand->execute($commandContext);
