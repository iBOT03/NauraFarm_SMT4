<?php

function belumlogin(){
    $check = get_instance();
    if(!$check->session->userdata('NAMA_LENGKAP')){
        redirect("admin/login");
    }
}

// function sudahlogin(){
//     $check = get_instance();
//     if($check->session->userdata('NAMA_LENGKAP')){
//         redirect("admin/Dashboard");
//     }
// }

?>