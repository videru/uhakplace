<?
##-------------------------------------------------------------------##
##  ���α׷��� : gmEditor v1.2
##-------------------------------------------------------------------##
##  ���� ���� �Ϸ��� : 2006-01-05
##  ���߻� �� ���۱��� : PHP����
##  ������Ʈ : http://www.phpmonster.co.kr
##  �� �� �� : �ڿ��� (misnam@gmail.com)
##-------------------------------------------------------------------##
##                           ī�Ƕ���Ʈ
##-------------------------------------------------------------------##
##  �� ���α׷��� ���� ���α׷����� �����˴ϴ�.
##  gmEditor�� GNU General Public License(GPL) �� �����ϴ�.
##  ���� �ڼ��� ������ LICENSE�� �����Ͻʽÿ�.
##  ����: http://korea.gnu.org/people/chsong/copyleft/gpl.ko.html
##-------------------------------------------------------------------##
##                           ����ȯ��
##-------------------------------------------------------------------##
##  Browser: �ͽ��÷η�, ���̾�����, �׽�������
##  Server : PHP�� �����Ǵ� ��� ����
##-------------------------------------------------------------------##

// �̹����� ����Ǵ� ���
$dir = "uploaded";

// �̵������ üũȮ����
$old = array(
	"mid",
	"rmi",
	"midi",
	"asx",
	"wax",
	"wax",
	"m3u",
	"mvx",
	"mov",
	"qt",
	"asf",
	"wm",
	"wma",
	"wmv",
	"mpeg",
	"mpg",
	"m1v",
	"mp2",
	"mp3",
	"avi",
	"wmv",
	"wav",
	"snd",
	"au",
	"aif",
	"aifc",
	"aiff",
	"rm",
	"ra",
	"ram",
	"swf"
);

Header ("Content-Type:text/html; charset=".$_POST['lang']);
ECHO "<script src='./languages/".$_POST['lang']."/java.lang.js'></script>";


$referer = explode('/',preg_replace("/http:\/\//",'',$_SERVER['HTTP_REFERER']));
if ($referer[0] <> $_SERVER['HTTP_HOST']) {
	ECHO "<script>window.alert(editor_lang[71]);</script>";
	exit;
}

if($_SERVER['REQUEST_METHOD'] <> 'POST') {

	ECHO "<script>window.alert(editor_lang[71]);</script>";
	exit;
}



// ���ε� ���丮�� �ִ��� üũ 
if (!@is_dir($dir)) {
	ECHO "<script>window.alert(editor_lang[72]);</script>";
	exit;
}

// ���ε� ������ �۹̼� 707���� üũ
if(((substr(PHP_OS,0,1) == 'W') ? 1 : 0) != 1){
	if(substr(decoct(fileperms($dir)),2) <> 707){
		ECHO "<script>window.alert(editor_lang[73]);</script>";
		exit;
	}
} // end if

// �̹��� ��ũ, �̵�� ��ũ
$link = addslashes(trim($_POST['link']));



/***************************************************************************************
*************************   ���� ����
****************************************************************************************/

if(empty($_POST['wr']) && empty($link) && is_uploaded_file($_FILES['upfile']['tmp_name']) && ($_FILES['upfile']['size'] > 0)) {

	$ext = substr($_FILES['upfile']['name'],strrpos(stripslashes($_FILES['upfile']['name']),'.')+1);
	$upfile = time().'.'.$ext;

	// �̹���, �̵�� ����
	$tmp_dir = $dir.'/'.(($_POST['mode']==1) ? 'img' : 'mid');
	if(!is_dir($tmp_dir)){
		@mkdir($tmp_dir,0707);
		@chmod($tmp_dir,0707);
	} // end if


	// �̹����̸�..
	if($_POST['mode']==1){
		$tmp_file = @getimagesize($_FILES['upfile']['tmp_name'],&$type);

		// (1) = gif, (2) = jpg, (3) = png, (4) = swf, (5) = psd, (6) = bmp
		if(($tmp_file[2] != 1) && ($tmp_file[2] != 2) && ($tmp_file[2] != 3) && ($tmp_file[2] != 6)) {
			ECHO "<script>window.alert(editor_lang[74]);</script>";
			exit;
		}
	}
	// �̵���̸�..
	else{
		$media_chk = '';
		foreach($old as $key => $value){
			if($value == $ext){
				$media_chk = 1;
				break;
			}
		}

		if($media_chk <> 1){
			ECHO "<script>window.alert(editor_lang[75]);</script>";
			exit;
		}
	} // end if


	if(!@move_uploaded_file($_FILES['upfile']['tmp_name'],$tmp_dir.'/'.$upfile)) {
		@unlink($tmp_dir.'/'.$upfile);
		ECHO "<script>window.alert(editor_lang[76]);</script>";
		exit;
	}
	@chmod($tmp_dir.'/'.$upfile,0606);
} // end if




/***************************************************************************************
*************************   ������ �����Ϳ� ����
****************************************************************************************/

ECHO "<script language='javascript'>\n";
ECHO "<!--\n";
ECHO "var val;\n";

if(is_file($tmp_dir.'/'.$upfile) || !empty($link)){

	$imgsize = (int)$_POST['imgsize'];
	$title = addslashes($_POST['title']);
	$alignment = $_POST['alignment'];
	$upfile_ok = $tmp_dir.'/'.addslashes($upfile);
	$file_path = $_POST['url'].'/'.$upfile_ok;

	ECHO "	val = '";

	// ���� 2-1
	if(!empty($alignment) && ($alignment=='center')){
		ECHO "<div align=\"".$alignment."\">";
	}

	// �̹������� ���ε�
	if($_POST['mode']==1){
		if(empty($link)){
			ECHO "<a style=\"cursor:hand;cursor:pointer;\" onclick=\"window.open(\'".$_POST['url']."/img_view.php?name=".urlencode($file_path)."&w=".$tmp_file[0]."&h=".$tmp_file[1]."\',\'_editor_tb\',\'staus=no, width=".$tmp_file[0].", height=".$tmp_file[1].",scrollbars=no,toolbar=no,menubar=no\')\">";
		}
		ECHO "<img src=\"";
		if(empty($link)) ECHO $file_path."\"";
		else ECHO $link."\"";

		if($alignment){
			ECHO " align=\"".$alignment."\"";
		}

		// �̹��� ũ��
		if(!empty($imgsize)){
			ECHO " width=\"".$imgsize."\"";
		}

		ECHO " hspace=5 vspace=5 border=0>";

		if(empty($link)){
			ECHO "</a>";
		}
	}
	// �̵������ ���ε�
	else{
		$size = $imgsize ? $imgsize : '300';
		ECHO "<embed src=\"".$file_path."\" ";
		ECHO " width=\"".$size."\" height=\"".$size."\"";
		ECHO " autostart=\"true\" loop=\"true\">";
	}

	// ���� 2-2
	if(!empty($alignment) && ($alignment=='center')){
		ECHO "</div>";
	}

	ECHO "';\n";
} // end if

ECHO "parent.insertHtml(val);\n";
ECHO "//-->\n";
ECHO "</script>\n";
ECHO "</BODY>";
ECHO "</HTML>";

?>
