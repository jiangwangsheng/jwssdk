<?php
namespace jws\alisdk\like;


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