<?php

function ispis_procenta(){
    $pod = file(LOG_FAJL);
    $vrednost = "";
    $strana = "";
    $brojacStrana = [];
    $currentDate = date('d-m-Y H:i:s');
    $stat = array();
    foreach($pod as $key=>$value){
        $linija = explode("\t",$value);
        $datum = strtotime($linija[2]);
        $stranica = explode("/", $linija[0]);
        $krajStranica = end($stranica);
        $krajStranica = trim($krajStranica);
        if((strtotime($currentDate) - $datum)<3600){
            if(array_key_exists($krajStranica,$brojacStrana)) {
                $brojacStrana[$krajStranica]++;      
            }
            else {
                $broj = 1.0;
                $brojacStrana +=[$krajStranica=>$broj];
            }
            
        }
    }

    foreach($brojacStrana as $key=>$val){
        $stat [] = $key . ": "  . round(100/(array_sum($brojacStrana)/$val)) . "   %  ";
        
    }
    //var_dump($brojacStrana);
    return $stat;
    
}