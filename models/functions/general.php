<?php 

function output_errors($errors){
    return "<ul <li class='error'>" . implode('</li><li>', $errors) . "</li></ul>";
}

?>