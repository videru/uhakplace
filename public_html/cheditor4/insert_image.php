<?php
include_once("_common.php");

//////////////////////////////////////////////////////////////////////////
// �̹��� ������ ����� ���丮 ��θ� �����մϴ�. �۹̼� 777
//
//define('SAVE_AS_DIRECTORY', 	"/home/account/www/cheditor/attach/");

@mkdir("$g4[path]/cheditor_img/", 0707);
@chmod("$g4[path]/cheditor_img/", 0707);
$ym = date("ym", $g4[server_time]);
define('SAVE_AS_DIRECTORY', 	"$g4[path]/cheditor_img/$ym/");
@mkdir(SAVE_AS_DIRECTORY, 0707);
@chmod(SAVE_AS_DIRECTORY, 0707);


//////////////////////////////////////////////////////////////////////////
// SAVE_AS_DIRECTOR�� ���� URL ��θ� �Է��մϴ�.
//
//define('SAVE_AS_URL', 		"http://udomain.com/cheditor/attach/");

define('SAVE_AS_URL', 		"$g4[url]/cheditor_img/$ym/");


//////////////////////////////////////////////////////////////////////////
// �̹��� ���� ������ �����մϴ�.
//
define('ALLOW_FORMAT',		"jpeg|jpg|gif|png");

//////////////////////////////////////////////////////////////////////////
// ���� ���� �ɼ��� �����մϴ�.
// ���� �̸��� �ѱ� �Ǵ� ���Ǿ� ���� �ȵ� Ư�����ڰ� ���� ���, �߶�����ϴ�.
//
// ���� �ɼ�:
// 1 = ���� �̸��� ������ ���� �ϸ� ���� ���ϴ�.
// 2 = ���� �̸��� ������ ������ ���, ���� �̸� �ڿ� _copy,jpg, _copy1.jpg ... ������ �̸��� ���Դϴ�.
// 3 = ���� �̸��� ������ ������ ���, ���ε����� �ʽ��ϴ�.
//
define('SAVE_OPTION',	 	2);

if ($_REQUEST['do'] == "submit") {
	require_once "imageupload-class.php";
    $attach = new uploader;

    //////////////////////////////////////////////////////////////////////////
    // �ɼ�:
    //
    // $attach->max_filesize(102400);        // �̹��� ���ε� �ִ� ũ��
	// $attach->max_image_size(1024, 1024);  // �̹��� ����, ���� �ִ� �ȼ� ũ��
	
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
