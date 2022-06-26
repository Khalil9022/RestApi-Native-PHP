<?php
require "koneksi.php";

ini_set('display_errors', 1);

if (function_exists($_GET['function'])) {
    $_GET['function']();
}

function get_user()
{
    global $connect;
    $query = $connect->query("SELECT * FROM user");
    while ($row = mysqli_fetch_object($query)) {
        $data[] = $row;
    }

    $respone = array(
        'status' => 1,
        'message' => "success",
        'data' => $data
    );
    header('Content-Type: application/json');
    echo json_encode($respone);
}

function get_user_id()
{
    global $connect;
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    }

    $query = $connect->query("SELECT * FROM user WHERE user_id= $id");
    while ($row = mysqli_fetch_object($query)) {
        $data[] = $row;
    }

    if ($data) {
        $respone = array(
            'status' => 1,
            'message' => 'success',
            'data' => $data
        );
    } else {
        $respone = array(
            'status' => 0,
            'message' => 'data not found'
        );
    }

    header('Content-Type: application/json');
    echo json_encode($respone);
}

function insert_user()
{
    global $connect;
    $insert = array(
        'nama' => '',
        'jenis_kelamin' => '',
        'alamat' => ''
    );

    $insert_match = count(array_intersect_key($_POST, $insert));
    if ($insert_match == count($insert)) {

        if ($insert['jenis_kelamin'] != 'Laki - Laki' or $insert['jenis_kelamin'] != 'Perempuan') {
            $respone = array(
                'status' => 0,
                'message' => "Jenis kelamin Salah!"
            );
            header('Content-Type: application/json');
            echo json_encode($respone);
            die();
        }

        $result = mysqli_query($connect, "INSERT INTO user SET 
        user_nama = '$_POST[nama]',
        user_jenis_kelamin = '$_POST[jenis_kelamin]',
        user_alamat = '$_POST[alamat]'");

        if ($result) {
            $respone = array(
                'status' => 1,
                'message' => "insert success"
            );
        } else {
            $respone = array(
                'status' => 0,
                'message' => "insert Failed"
            );
        }
    } else {
        $respone = array(
            'status' => 0,
            'message' => 'wrong parameter'
        );
    };

    header('Content-Type: application/json');
    echo json_encode($respone);
}
