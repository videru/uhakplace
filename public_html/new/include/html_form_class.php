<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================
	
	���������� : 
 ===================================================== */
 
if (!defined('HTML_FORM_INC_INCLUDED')) 
{
	define('HTML_FORM_INC_INCLUDED', 1);
// *-- HTML_FORM_INC_INCLUDED START --*
	class html_form
	{
		// input �±� �⺻��
		var $type; // ����
		var $size;
		var $maxlength;
		var $value;
		var $class;
		
		var $cols; // textarea ��
		var $rows;
		
		var $hname; // validata �߰�
		var $option;
		var $span;
		var $required;
		
		var $method; // form �±׿�
		var $action;
//		var $onsubmit;
		var $enctype;
		
		function clear()
		{
			$this->type='text';
			$this->size='20';
			$this->maxlength='';
			$this->value='';
			$this->class='';
			
			$this->cols='';
			$this->rows='';
			
			$this->hname='';
			$this->option='';
			$this->span='';
			$this->required=0;
			
			$this->method='POST';
			$this->action='';
			$this->enctype='';
		}
		
		function html_form() {
			$this->clear();
		}
		
		function input($type,$options,$value) {
			$options=explode(',',$options);
			foreach ($options as $option) {
				$tag=explode('=',$option);
			}
		}
	} 
} // *-- HTML_FORM_INC_INCLUDED END --*
?>