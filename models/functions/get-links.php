<?php

function get_menu(){
    $menu = executeQuery("SELECT * FROM menu");
    return $menu;
}