<?php

class LagoutModel{

    public function lagout(){

        session_start();
        session_destroy();
        header("Location: ../PUBLIC/index"); 
        exit();
    }
}