<?php
$dir = 'hdd/public/wei_san/.submarin_files/';
//$dir = 'files/';
$url = '[pic]:https://山D.com/storage/wei_san/.submarin_files/';
function filetypeA($file){
    switch (mime_content_type($file)){
        case 'image/jpeg':
            $f = '.jpg';
        break;
        case 'image/png':
            $f = '.png';
        break;
        case 'image/gif':
            $f = '.GIF';
        break;
        default:
        $f = false;
    }
    return $f;
}
function genfname() {
    $f_name = substr(str_shuffle('1234567890abcdef'), 0, 5);
    return $f_name;
}
$upf = $_FILES["upfile"]["tmp_name"];
$RANDOM = genfname();
$FT = filetypeA($upf);
if($FT){
    $FN = $dir.$RANDOM.$FT;
   // echo($FN);
    if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
        if (move_uploaded_file($upf, $FN)) {
            chmod($FN, 0644);
            echo($url.$FN);
        } else {
            http_response_code(500);
            echo "err1";
        }
    } else {
        http_response_code(500);
        echo "err2";
    }
} else {
    http_response_code(500);
    echo 'err3';
}
?>
