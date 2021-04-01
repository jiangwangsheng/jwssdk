<?php
namespace like;
interface A {
    public function send();
    // public function add();
}

abstract class A2 implements A {
    public function send() {
        echo "sendA2";
    }
}

class A3 extends A2 {
    public function send() {
        echo "sendA3";
    }
}
// class A4 {
//     protected $msg;

//     public function __construct(A $a) {
//         $this->msg = $a;
//     }

//     public function send() {
//         $this->msg->send();
//     }
// }

// $class = new A4(new A3);
// $class->send();

class A4 {
    protected $bind = [];

    protected $intances = [];

    public function bind($class_name, $new_class) {
        if(!$new_class instanceof Closure) {
            $this->intances[$class_name] = $new_class;
        } else {
            $this->bind[$class_name] = $new_class;
        }
    }

    public function make($class_name, $param = []) {

        if(isset($this->intances[$class_name])) {
            return $this->intances[$class_name];
        }

        // array_unshift($param, $this);
        return call_user_func_array($this->bind[$class_name], $param);
    }
}