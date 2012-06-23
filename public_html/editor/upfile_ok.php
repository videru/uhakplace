<?
##-------------------------------------------------------------------##
##  프로그램명 : gmEditor v1.2
##-------------------------------------------------------------------##
##  최초 개발 완료일 : 2006-01-05
##  개발사 및 저작권자 : PHP몬스터
##  웹사이트 : http://www.phpmonster.co.kr
##  개 발 자 : 박요한 (misnam@gmail.com)
##-------------------------------------------------------------------##
##                           카피라이트
##-------------------------------------------------------------------##
##  본 프로그램은 무료 프로그램으로 배포됩니다.
##  gmEditor는 GNU General Public License(GPL) 를 따릅니다.
##  보다 자세한 내용은 LICENSE를 참조하십시요.
##  참고: http://korea.gnu.org/people/chsong/copyleft/gpl.ko.html
##-------------------------------------------------------------------##
##                           개발환경
##-------------------------------------------------------------------##
##  Browser: 익스플로러, 파이어폭스, 네스케이프
##  Server : PHP가 지원되는 모든 서버
##-------------------------------------------------------------------##

// 이미지가 저장되는 경로
$dir = "uploaded";

// 미디어파일 체크확장자
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



// 업로드 디렉토리가 있는지 체크 
if (!@is_dir($dir)) {
	ECHO "<script>window.alert(editor_lang[72]);</script>";
	exit;
}

// 업로드 폴더의 퍼미션 707인지 체크
if(((substr(PHP_OS,0,1) == 'W') ? 1 : 0) != 1){
	if(substr(decoct(fileperms($dir)),2) <> 707){
		ECHO "<script>window.alert(editor_lang[73]);</script>";
		exit;
	}
} // end if

// 이미지 링크, 미디어 링크
$link = addslashes(trim($_POST['link']));



/***************************************************************************************
*************************   파일 전송
****************************************************************************************/

if(empty($_POST['wr']) && empty($link) && is_uploaded_file($_FILES['upfile']['tmp_name']) && ($_FILES['upfile']['size'] > 0)) {

	$ext = substr($_FILES['upfile']['name'],strrpos(stripslashes($_FILES['upfile']['name']),'.')+1);
	$upfile = time().'.'.$ext;

	// 이미지, 미디어 폴더
	$tmp_dir = $dir.'/'.(($_POST['mode']==1) ? 'img' : 'mid');
	if(!is_dir($tmp_dir)){
		@mkdir($tmp_dir,0707);
		@chmod($tmp_dir,0707);
	} // end if


	// 이미지이면..
	if($_POST['mode']==1){
		$tmp_file = @getimagesize($_FILES['upfile']['tmp_name'],&$type);

		// (1) = gif, (2) = jpg, (3) = png, (4) = swf, (5) = psd, (6) = bmp
		if(($tmp_file[2] != 1) && ($tmp_file[2] != 2) && ($tmp_file[2] != 3) && ($tmp_file[2] != 6)) {
			ECHO "<script>window.alert(editor_lang[74]);</script>";
			exit;
		}
	}
	// 미디어이면..
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
*************************   내용을 에디터에 삽입
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

	// 정렬 2-1
	if(!empty($alignment) && ($alignment=='center')){
		ECHO "<div align=\"".$alignment."\">";
	}

	// 이미지파일 업로드
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

		// 이미지 크기
		if(!empty($imgsize)){
			ECHO " width=\"".$imgsize."\"";
		}

		ECHO " hspace=5 vspace=5 border=0>";

		if(empty($link)){
			ECHO "</a>";
		}
	}
	// 미디어파일 업로드
	else{
		$size = $imgsize ? $imgsize : '300';
		ECHO "<embed src=\"".$file_path."\" ";
		ECHO " width=\"".$size."\" height=\"".$size."\"";
		ECHO " autostart=\"true\" loop=\"true\">";
	}

	// 정렬 2-2
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
