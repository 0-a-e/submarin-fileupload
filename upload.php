<?php
$_error = 0;

/* ERROR CODE
 * error 1 => upload failed
 * error 2 => file type error
 * error 3 => file exists
 * error 4 => passwd error
 * error 7 => file moving error
*/

# put directory and directory url
$p_dir = 'hdd/public/wei_san/.submarin_files/';
//$p_dir = 'files/';
$p_str = '[pic]:https://山D.com/storage/wei_san/.submarin_files/';

# to get temporary (uploaded)file full path => l_uploaded()
function l_uploaded() {
    global $_error;
    $f_uploaded = $_FILES['upfile']['tmp_name'];
    if (is_uploaded_file($f_uploaded)) {
        return $f_uploaded;
    } else {
        $_error = 1;
    }
}
# random name gen => genfname()
function genfname() {
    global $_error;
    $f_name = substr(str_shuffle('1234567890abcdef'), 0, 5). ".png";
    if ($_error == 0) {
        if (file_exists($p_dir.$f_name)) {
            $_error = $_error. 3;
        }
        return $f_name;
    }
}

// PASSWD AUTH //
$_passwd = 'subway_3';
if ($_POST['p'] !== $_passwd) {
    if ($_GET['p'] !== $_passwd) {
        $_error = 5;
    }
}

// User Agent Auth //
#if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/^Android/u', $_SERVER['HTTP_USER_AGENT'])) {
#} else {
# $_error = 6;
# }

// MAIN PROCESSING //
$fname = genfname();
$_url = $p_str.$fname;
$file = l_uploaded();
if ($_error == 0) {
  echo($file_path);
	if (move_uploaded_file($file,$p_dir.$fname)) {
          echo($_url);
  } else {
    http_response_code(500);
    echo 'error :'.'7';
  }
  
} else {
    http_response_code(500);
    echo 'error :'.$_error;
}

?>
