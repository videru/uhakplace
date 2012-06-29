<?php
include_once("_common.php");

//////////////////////////////////////////////////////////////////////////
// 이미지 파일이 저장될 디렉토리 경로를 지정합니다. 퍼미션 777
//
//define('SAVE_AS_DIRECTORY', 	"/home/account/www/cheditor/attach/");

@mkdir("$g4[path]/cheditor_img/", 0707);
@chmod("$g4[path]/cheditor_img/", 0707);
$ym = date("ym", $g4[server_time]);
define('SAVE_AS_DIRECTORY', 	"$g4[path]/cheditor_img/$ym/");
@mkdir(SAVE_AS_DIRECTORY, 0707);
@chmod(SAVE_AS_DIRECTORY, 0707);


//////////////////////////////////////////////////////////////////////////
// SAVE_AS_DIRECTOR에 대한 URL 경로를 입력합니다.
//
//define('SAVE_AS_URL', 		"http://udomain.com/cheditor/attach/");

define('SAVE_AS_URL', 		"$g4[url]/cheditor_img/$ym/");


//////////////////////////////////////////////////////////////////////////
// 이미지 파일 형식을 설정합니다.
//
define('ALLOW_FORMAT',		"jpeg|jpg|gif|png");

//////////////////////////////////////////////////////////////////////////
// 파일 저장 옵션을 설정합니다.
// 파일 이름에 한글 또는 사용되어 서는 안될 특수문자가 있을 경우, 잘라버립니다.
//
// 저장 옵션:
// 1 = 같은 이름의 파일이 존재 하면 덮어 씁니다.
// 2 = 같은 이름의 파일이 존재할 경우, 파일 이름 뒤에 _copy,jpg, _copy1.jpg ... 식으로 이름을 붙입니다.
// 3 = 같은 이름의 파일이 존재할 경우, 업로드하지 않습니다.
//
define('SAVE_OPTION',	 	2);

if ($_REQUEST['do'] == "submit") {
	require_once "imageupload-class.php";
    $attach = new uploader;

    //////////////////////////////////////////////////////////////////////////
    // 옵션:
    //
    // $attach->max_filesize(102400);        // 이미지 업로드 최대 크기
	// $attach->max_image_size(1024, 1024);  // 이미지 가로, 세로 최대 픽셀 크기
	
	$attach->max_image_size(8096, 8096);
    $success = $attach->upload("AttachFile", ALLOW_FORMAT, "");

   	if ($success) {
       	$success = $attach->save_file(SAVE_AS_DIRECTORY, SAVE_OPTION);
		$filename = SAVE_AS_URL . $attach->file['name'];

       	echo '<script type="text/javascript">';
      	echo 'var obj = parent.window.insert_form;';
		echo 'obj.attachSuccess(\''.$filename.'\');';
       	echo '</script>';
   	}
   	else {
		if ($attach->errors) {
			$msg = '';
           	while (list($k, $v) = each($attach->errors)) {
               	$msg .= $v;
           	}
			echo '<script type="text/javascript">';
			echo 'alert(\''.$msg.'\');';
			echo '</script>';
       	}
	}
}
else if ($_REQUEST['do'] == "delete") {
	foreach (explode(' ', $_REQUEST['img']) as $del) {
		$del = trim($del);
		$file = SAVE_AS_DIRECTORY . $del;
		if (is_file($file)) {
			unlink($file);
		}
	}
	echo true;
}

?>
