<?php
    interface IState {
        public function someAction();
    }
    
    class Context {
        private $state;

        function setState(IState $state) {
            $this->state = $state;
        }

        function __construct(IState $state) {
            $this->state = $state;
        }

        function runAction() {
            $this->state->someAction();
        }
    }

    class StartState implements IState {
        function someAction() {
            print_r("StartState <br />");
        }
    }
    
    class ActionState implements IState {

        function someAction() {
            print("ActionState <br />");
        }
    }
    
    class WinState implements IState {

        function someAction() {
            print("WinState <br />");
        }
    }
    
    $startState = new StartState();
    $context = new Context($startState);
    $context->runAction();
    
    $actionState = new ActionState();
    $context = new Context($actionState);
    $context->runAction();

    
    $winState = new WinState();
    $context->setState($winState);
    $context->runAction();
    


