<?php
// print_r($_SESSION);
if (isset($_SESSION['user_role_id']) or isset($_SESSION['kd_peminjam'])) {
    if (isset($_SESSION['user_role_id'])) {
        $user_role = $_SESSION['user_role_id'];
        $url_path = $_SERVER['REQUEST_URI']; // untuk full url

        $queries = array();
        parse_str($_SERVER['QUERY_STRING'], $queries);
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    // print_r($queries['page']);
    }elseif (isset($_SESSION['kd_peminjam'])){
        $user_role = $_SESSION['kd_peminjam'];
        $url_path = $_SERVER['REQUEST_URI']; // untuk full url

        $queries = array();
        parse_str($_SERVER['QUERY_STRING'], $queries);
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    // print_r($queries['page']);
    }
    
    if ($user_role == 1) {
        // 1 = kepala rm
        $exception = [
            // 'tampil_pasien',
            // 'tambah_pasien',
            // 'tampil_petugas',
            // 'tambah_petugas',
            // 'tampil_pasien_PRJ'
        ];

        if (count($exception)) {
            foreach ($exception as $key => $value) 
            {
                if (
                    $queries['page'] == $value
                    ) {
                        header('HTTP/1.1 404 Not Found');
                        // header('HTTP/1.0 404 Forbidden', TRUE, 404); 
                        die(header('location: 404.php'));
                    }
                }
        }

        $just_admited = [
            // '',
            // '',
            // '',
        ];
        // echo count($just_admited);
        if (count($just_admited) > 0) {   
            foreach ($just_admited as $key => $value) {
                if ($queries['page'] != $value) {
                    header('HTTP/1.1 404 Not Found');
                    // header('HTTP/1.0 404 Forbidden', TRUE, 404); 
                    die(header('location: 404.php'));
                }
            }
        }
    }
    elseif ($user_role == 2 ) {
        // 2 =  admin
        
    }
    else {
        // 3 = peminjam
        $exception = [
            'tampil_pasien',
            'tambah_pasien',
            'tampil_petugas',
            'tambah_petugas',
            'tampil_pasien_PRJ'
        ];

        if (count($exception)) {
            foreach ($exception as $key => $value) {
                if (
                    $queries['page'] == $value
                ) {
                    header('HTTP/1.1 404 Not Found');
                    // header('HTTP/1.0 404 Forbidden', TRUE, 404); 
                    die(header('location: 404.php'));
                }
            }
        }
    }
  


if (isset($_SESSION['kd_peminjam'])) { {
        // session = peminjam
        $exception = [
            'tampil_pasien',
            'tambah_pasien',
            'tampil_petugas',
            'tambah_petugas',
            'tampil_pasien_PRJ'
        ];

        if (count($exception)) {
            foreach ($exception as $key => $value) {
                if ($queries['page'] == $value) {
                    header('HTTP/1.1 404 Not Found');
                    // header('HTTP/1.0 404 Forbidden', TRUE, 404); 
                    die(header('location: 404.php'));
                }
            }
        }
    }
}
}





?>