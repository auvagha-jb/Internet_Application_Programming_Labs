<?php

interface Crud {
    /**
     * All these methods are to be implemented by any
     *  class that implements these interface
     * */
    
     public function save();
     public function readAll($table);
     public function readUnique();
     public function search();
     public function update();
     public function removeOne();
     public function removeAll();

    /**
     * Added in lab 2
     */
    public function validateForm();
    public function createFormErrorSessions();

}