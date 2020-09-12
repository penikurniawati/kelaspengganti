<?php 
function in_access()
{
    $ci=& get_instance();
    if($ci->session->userdata('user')){
        redirect('dashboardAdminR');
    }
}
function no_access()
{
    $ci=& get_instance();
    if(!$ci->session->userdata('user')){
        redirect('loginAdmin');
    }
}

function in_accessuser()
{
    $ci=& get_instance();
    if($ci->session->userdata('user')){
        if ($ci->session->userdata('id_userrole')==1) {
            redirect('jadwalAkademikR');
        }
        elseif ($ci->session->userdata('id_userrole')==2) {
            redirect('jadwalDosenR');
        }
        
    }
}
function no_accessuser()
{
    $ci=& get_instance();
    if(!$ci->session->userdata('user')){
        redirect('loginUserR');
    }
}
function cekUserAkademik()
{
    $ci=& get_instance();
    if ($ci->session->userdata('id_userrole')!=1) {
        redirect('noAksesR');
    }
}
function cekUserDosen()
{
    $ci=& get_instance();
    if ($ci->session->userdata('id_userrole')!=2) {
        redirect('noAksesR');
    }
}
function cekUserAdmin()
{
    $ci=& get_instance();
    if ($ci->session->userdata('akses')!='admin') {
        redirect('noAksesR');
    }
}