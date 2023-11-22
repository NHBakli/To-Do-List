<?php

class HomeModel {

    public function home(){

    }

    public function link(){

        if (empty($_SESSION)) {
            return "index?page=login";
        } else {
            return "index?page=list&action=create";
        }
    }
}