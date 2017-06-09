<?php

    class User {
        private $login;
        private $password;
        
        function getLogin() {
            return $this->login;
        }

        function getPassword() {
            return $this->password;
        }

        function setLogin($login) {
            $this->login = $login;
        }

        function setPassword($password) {
            $this->password = $password;
        }
    }

    abstract class BaseBuilder {

        protected $user;
        
        function __construct() {
            $this->user = new User();
        }
        
        function getUser() {
            return $this->user;
        }

        public abstract function buildLogin();
        public abstract function buildPassword();
    }

    class BuilderA extends BaseBuilder {
        public function buildLogin() {
            print_r(" buildLogin BuilderA<br />");
        }

        public function buildPassword() {
            print_r(" buildPassword BuilderA<br />");
        }
    }
    
    class BuilderB extends BaseBuilder {
        public function buildLogin() {
            print_r(" buildLogin BuilderB<br />");
        }

        public function buildPassword() {
            print_r(" buildPassword BuilderB<br />");
        }
    }
    
    class Director {
        public static function createUser($builder) {
            $builder->buildLogin();
            $builder->buildPassword();

            return $builder->getUser();
        }
    }
    
    Director::createUser(new BuilderA());
    Director::createUser(new BuilderB());