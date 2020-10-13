<?php 

    function formattanggal($date){
        $tanggal = date('m/d/Y', strtotime($date));
        return $tanggal;
    }
    function tanggal($date){
        return date('Y-m-d H:i:s', strtotime($date));
    }

?>