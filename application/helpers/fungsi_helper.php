<?php

function cek_login()
{
    $ci = get_instance();
    if (!$ci->session->has_userdata('login_session')) {
        set_pesan('silahkan login.');
        redirect('auth');
    }
}

function is_pelamar() {
    $ci = get_instance();
    if($ci->session->userdata('login_session')['role'] == 3){
        redirect('home');
    }
}

function is_admin()
{
    $ci = get_instance();
    $role = $ci->session->userdata('login_session')['role'];

    $status = true;

    if ($role != 'master') {
        $status = false;
    }

    return $status;
}

function set_pesan($pesan, $tipe = true)
{
    $ci = get_instance();
    if ($tipe) {
        $ci->session->set_flashdata('pesan', "<div class='alert alert-success'><strong>SUCCESS!</strong> {$pesan} <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
    } else {
        $ci->session->set_flashdata('pesan', "<div class='alert alert-danger'><strong>ERROR!</strong> {$pesan} <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
    }
}

function userdata($field)
{
    $ci = get_instance();
    $ci->load->model('Base_model', 'base');

    $userId = $ci->session->userdata('login_session')['user'];
    return $ci->base->getUser('user', ['id_user' => $userId])[$field];
}

function output_json($data)
{
    $ci = get_instance();
    $data = json_encode($data);
    $ci->output->set_content_type('application/json')->set_output($data);
}


function tampil_media($file, $width = "", $height = "")
{
    $ret = '';

    $pc_file = explode(".", $file);
    $eks = end($pc_file);

    $eks_video = array("mp4", "flv", "mpeg");
    $eks_audio = array("mp3", "acc");
    $eks_image = array("jpeg", "jpg", "gif", "bmp", "png");


    if (!in_array($eks, $eks_video) && !in_array($eks, $eks_audio) && !in_array($eks, $eks_image)) {
        $ret .= '';
    } else {
        if (in_array($eks, $eks_video)) {
            if (is_file("./" . $file)) {
                $ret .= '<p><video width="' . $width . '" height="' . $height . '" controls>
                <source src="' . base_url() . $file . '" type="video/mp4">
                <source src="' . base_url() . $file . '" type="application/octet-stream">Browser tidak support</video></p>';
            } else {
                $ret .= '';
            }
        }

        if (in_array($eks, $eks_audio)) {
            if (is_file("./" . $file)) {
                $ret .= '<p><audio width="' . $width . '" height="' . $height . '" controls>
				<source src="' . base_url() . $file . '" type="audio/mpeg">
				<source src="' . base_url() . $file . '" type="audio/wav">Browser tidak support</audio></p>';
            } else {
                $ret .= '';
            }
        }

        if (in_array($eks, $eks_image)) {
            if (is_file("./" . $file)) {
                $ret .= '<img class="thumbnail w-100" src="' . base_url() . $file . '" style="width: ' . $width . '; height: ' . $height . ';">';
            } else {
                $ret .= '';
            }
        }
    }


    return $ret;
}

function tampil_jawaban($file, $width = "", $height = "")
{
    $ret = '';

    $pc_file = explode(".", $file);
    $eks = end($pc_file);

    $eks_video = array("mp4", "flv", "mpeg");
    $eks_audio = array("mp3", "acc");
    $eks_image = array("jpeg", "jpg", "gif", "bmp", "png");


    if (!in_array($eks, $eks_video) && !in_array($eks, $eks_audio) && !in_array($eks, $eks_image)) {
        $ret .= '';
    } else {
        if (in_array($eks, $eks_video)) {
            if (is_file("./" . $file)) {
                $ret .= '<p><video width="' . $width . '" height="' . $height . '" controls>
                <source src="' . base_url() . $file . '" type="video/mp4">
                <source src="' . base_url() . $file . '" type="application/octet-stream">Browser tidak support</video></p>';
            } else {
                $ret .= '';
            }
        }

        if (in_array($eks, $eks_audio)) {
            if (is_file("./" . $file)) {
                $ret .= '<p><audio width="' . $width . '" height="' . $height . '" controls>
				<source src="' . base_url() . $file . '" type="audio/mpeg">
				<source src="' . base_url() . $file . '" type="audio/wav">Browser tidak support</audio></p>';
            } else {
                $ret .= '';
            }
        }

        if (in_array($eks, $eks_image)) {
            if (is_file("./" . $file)) {
                $ret .= '<img class="thumbnail w-50" src="' . base_url() . $file . '" style="width: ' . $width . '; height: ' . $height . ';">';
            } else {
                $ret .= '';
            }
        }
    }


    return $ret;
}
