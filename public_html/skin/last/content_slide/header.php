<style type="text/css">
.guide{/*��ü �����*/
text-align:left;
width: <?=$lay_wid?>px;
}

.contentslide{/*����*/
padding: 5px;
height: <?=$lay_hei?>px;
overflow-y: auto;
}

.contentslide .contentdiv{
display: none;
}

.pagination{/*�����̵� ��*/
text-align: right;
padding:1px 0px 0px 0px;
border-top:1px solid #CCC;
}

.pagination a{/*����Ʈ*/
color: #777;
padding: 0px 4px 0px 4px;
text-decoration: none; 
background-color: white;
border:1px solid #999;
}

.pagination a:hover, .pagination a.selected{/*ǥ�õ�..*/
color: #fff;
font-weight:bold;
background-color: #666;
}
</style>
<script type="text/javascript" src="<?=$skin_url?>js/contentslider.js"></script>
<div id="<?=$bbs_code?>" class="contentslide">