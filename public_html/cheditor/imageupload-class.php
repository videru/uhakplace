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

    function max_filesize($size){
        $this->max_filesize = $size;
    }

    function max_image_size($width, $height){
        $this->max_image_width  = $width;
        $this->max_image_height = $height;
    }

    function upload($filename='', $accept_type='', $extention='') {
        global $_FILES;
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
            if ($this->max_image_width || $this->max_image_height) {
                $image = getimagesize($this->file["tmp_name"]);
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
                    $this->file["extention"] = ".tif"; break;
                default:
                    $this->file["extention"] = $extention; break;
            }
        }
        elseif (!ereg("(\.)([a-z0-9]{3,5})$", $this->file["name"]) && !$extention) {
            switch($this->file["type"]) {
                case "text/plain":
                    $this->file["extention"] = ".txt"; break;
                case "text/richtext":
                    $this->file["extention"] = ".txt"; break;
                default:
                    break;
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
            $this->file["name"] = ereg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($this->file["name"]))));

            if (ereg("text", $this->file["type"])) {
                $this->cleanup_text_file($this->file["tmp_name"]);
            }

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
                    @chmod($this->path . $this->file["name"], 0606);
                    break;
                case 2:
                    while (file_exists($this->path . $this->file['raw_name'] . $copy . $this->file["extention"])) {
                        $copy = "_copy" . $n;
                        $n++;
                    }

                    $this->file["name"]  = $this->file['raw_name'] . $copy . $this->file["extention"];
                    $aok = move_uploaded_file($this->file["tmp_name"], $this->path . $this->file["name"]);
                    @chmod($this->path . $this->file["name"], 0606);
                    break;
                case 3:
                    if (file_exists($this->path . $this->file["name"])){
                        $this->errors[4] = "&quot" . $this->path . $this->file["name"] . "&quot 파일이 존재합니다.";
                        $aok = null;
                    }
                    else {
                        $aok = move_uploaded_file($this->file["tmp_name"], $this->path . $this->file["name"]);
                        @chmod($this->path . $this->file["name"], 0606);
                    }
                    break;
                default:
                    break;
            }

            if(!$aok) { unset($this->file['tmp_name']); }
            return $aok;
        }
        else {
            $this->errors[3] = ereg_replace("\|", " 또는 ", $accept_type) . " 파일만 업로드 할 수 있습니다.";
            return FALSE;
        }
    }

    function cleanup_text_file($file){
        $new_file  = '';
        $old_file  = '';
        $fcontents = file($file);
        while (list ($line_num, $line) = each($fcontents)) {
            $old_file .= $line;
            $new_file .= str_replace(chr(13), chr(10), $line);
        }
        if ($old_file != $new_file) {
            $fp = fopen($file, "w");
            fwrite($fp, $new_file);
            fclose($fp);
        }
    }

}
?>