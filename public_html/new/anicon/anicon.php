<script src=../anicon/anicon_layer.js></script>
<?
function anicon_html($str,$site_url)
// ���κ��� ������ �ƴ� ��Ų ������ ���ε� �� ��� ���� �� "$dir" ��� "."�� �־���.
{
$left_po = "140px"; //���̾��� ���� ��ġ�� �־��ݴϴ�.
$top_po = "200px"; //���̾��� ���� ��ġ�� �־��ݴϴ�.

for($i=1;$i<41;$i++) {
($i<10)?$j="0".$i:$j=$i;
$str=eregi_replace("ani_con_$j","
<div id='anicon$i' style='width:450px; height:300px; 
position:absolute; left:$left_po; top:$top_po; z-index:13;'><embed src='../anicon/anicon$i.swf' quality=high
pluginspage='http://www.macromedia.com/shockwave/download/
index.cgi?P1_Prod_Version=ShockwaveFlash' type='application/x-shockwave-flash' wmode='transparent' width=450 height=300></div>
",$str);
}
  return $str;

}

?>
