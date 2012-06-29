<?php
/*
** CHEditor Image Upload Class
**
*/

class uploader {

    var $file;
    var $errors;
    var $accepted;
    var $max_filesize;
    var $max_image_width;
    var $max_image_height;

    function max_filesize($size) {
        $this->max_filesize = $size;
    }

    function max_image_size($width, $height) {
        $this->max_image_width  = $width;
        $this->max_image_height = $height;
    }

    function upload($filename='', $accept_type='', $extention='') {
        global $_FILES;
        if (!$_FILES[$filename]['type']) return FALSE;
        if (!$filename || $filename == "none") {
            $this->errors[0] = "파일을 업로드 할 수 없습니다.";
            $this->accepted  = FALSE;
            return FALSE;
        }

        $this->file = $_FILES[$filename];
        $this->file['file'] = $filename;

        if ($this->max_filesize) {
            if ($this->file["size"] > $this->max_filesize) {
                $this->errors[1] = "최대 파일 크기 오류: " . $this->max_filesize/1000 . "KB (" . $this->max_filesize . " bytes).";
                $this->accepted  = FALSE;
                return FALSE;
            }
        }

        if (ereg("image", $this->file["type"])) {
            $image = getimagesize($this->file["tmp_name"]);

            if ($this->max_image_width || $this->max_image_height) {
                $this->file["width"]  = $image[0];
                $this->file["height"] = $image[1];

                if (($this->file["width"] > $this->max_image_width) || ($this->file["height"] > $this->max_image_height)) {
                    $this->errors[2] = "최대 이미지 크기 오류: " . $this->max_image_width . " x " . $this->max_image_height . " 픽셀";
                    $this->accepted  = FALSE;
                    return FALSE;
                }
            }

            switch ($image[2]) {
                case 1:
                    $this->file["extention"] = ".gif"; break;
                case 2:
                    $this->file["extention"] = ".jpg"; break;
                case 3:
                    $this->file["extention"] = ".png"; break;
                case 4:
                    $this->file["extention"] = ".swf"; break;
                case 5:
                    $this->file["extention"] = ".psd"; break;
                case 6:
                    $this->file["extention"] = ".bmp"; break;
                case 7:
                    $this->file["extention"] = ".tif"; break;
                case 8:
                    $this->file["extention"] = ".tga"; break;
                default:
                    $this->file["extention"] = $extention; break;
            }
        }
        else {
            $this->file["extention"] = $extention;
        }

        if ($accept_type) {
            if (ereg(strtolower($accept_type), strtolower($this->file["type"]))) {
                $this->accepted = TRUE;
            }
            else {
                $this->accepted = FALSE;
                $this->errors[3] = ereg_replace("\|", " 또는 ", $accept_type) . " 파일만 업로드 할 수 있습니다.";
            }
        }
        else {
            $this->accepted = TRUE;
        }
        return $this->accepted;
    }

    function save_file($path, $overwrite_mode="3"){
        $this->path = $path;

        if ($this->accepted) {
            $this->file["name"] = $this->random_generator();

            if (ereg("(\.)([a-z0-9]{2,5})$", $this->file["name"])) {
                $pos = strrpos($this->file["name"], ".");

                if (!$this->file["extention"]) {
                    $this->file["extention"] = substr($this->file["name"], $pos, strlen($this->file["name"]));
                }

                $this->file['raw_name'] = substr($this->file["name"], 0, $pos);
            }
            else {
                $this->file['raw_name'] = $this->file["name"];
                if ($this->file["extention"]) {
                    $this->file["name"] = $this->file["name"] . $this->file["extention"];
                }
            }

            switch($overwrite_mode) {
                case 1:
                    $aok = move_uploaded_file($this->file["tmp_name"], $this->path . $this->file["name"]);
                    chmod($this->path . $this->file["name"], 0644);
                    break;
                case 2:
                    $copy = '';
                    $n = 1;
                    while (file_exists($this->path . $this->file['raw_name'] . $copy . $this->file["extention"])) {
                        $copy = "_copy" . $n;
                        $n++;
                    }

                    $this->file["name"]  = $this->file['raw_name'] . $copy . $this->file["extention"];
                    $aok = move_uploaded_file($this->file["tmp_name"], $this->path . $this->file["name"]);
                    chmod($this->path . $this->file["name"], 0644);
                    break;
                case 3:
                    if (file_exists($this->path . $this->file["name"])){
                        $this->errors[4] = "&quot" . $this->path . $this->file["name"] . "&quot 파일이 존재합니다.";
                        $aok = null;
                    }
                    else {
                        $aok = move_uploaded_file($this->file["tmp_name"], $this->path . $this->file["name"]);
                        chmod($this->path . $this->file["name"], 0644);
                    }
                    break;
                default:
                    break;
            }

            if(!$aok) {
                unset($this->file['tmp_name']);
            }

            return $aok;
        }
        else {
            $this->errors[3] = ereg_replace("\|", " 또는 ", $accept_type) . " 파일만 업로드 할 수 있습니다.";
            return FALSE;
        }
    }

    function random_generator ($min=8, $max=32, $special=NULL, $chararray=NULL) {
        $random_chars = array();
    
        if ($chararray == NULL) {
            $str = "abcdefghijklmnopqrstuvwxyz";
            $str .= strtoupper($str);
            $str .= "1234567890";

            if ($special) {
                $str .= "!@#$%";
            }
        }
        else {
            $str = $charray;
        }

        for ($i=0; $i<strlen($str)-1; $i++) {
            $random_chars[$i] = $str[$i];
        }

        srand((float)microtime()*1000000);
        shuffle($random_chars);

        $length = rand($min, $max);
        $rdata = '';
    
        for ($i=0; $i<$length; $i++) {
            $char = rand(0, count($random_chars) - 1);
            $rdata .= $random_chars[$char];
        }
        return $rdata;
    }
}
?>
