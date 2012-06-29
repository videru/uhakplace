if (REQUIRE_ONCE_LIB_VALIDATE == null)
{
	// 한번만 실행되게
	var REQUIRE_ONCE_LIB_VALIDATE = true;

		/**
	* 파일명: lib.validate.js
	* 설  명: 폼 체크, 값 표준화
	* 작성자: jstoy project
	* 날  짜: 2003-10-24
			- 2004.02.18 setValue, getValue 폼.values 기능 추가
			- 2004.02.20 그룹화 필수기능 추가 ex) required="test" requirenum="2"
			- 2004.02.25 onsubmit="return validate(this)" 기능을 다시 넣었습니다..
			- 2004.02.26 간단한 debugging 기능 추가 (try..catch..구문 사용)
	***********************************************
	*/
	
	var FormCheckerObject = null;
	var FormCheckerLoadAction = null;
//	var FormCheckerLoadAction = window.onload;

/*	window.onload = function() {
			try {
					FormCheckerLoadAction();
			} catch (e) {
					// null
			}
			FormCheckerObject = new FormChecker;
	}*/
	
	function validate(form)
	{
			if(!FormCheckerObject) {
					FormCheckerObject = new FormChecker;
			}
			try {
					return FormCheckerObject.validate(form);
			} catch (e) {
					alert(e);
					return false;
			}
	}
	
	FormChecker = function() {
			var classObj = this;
	
			// 미리 정의된 에러 메시지들
			this.FORM_ERROR_MSG = {
//				 common   : "입력하신 내용이 규칙에 어긋납니다.\n규칙에 어긋나는 내용을 바로잡아주세요.",
				 common   : "",
	
//				 required : "반드시 입력하셔야 하는 사항입니다.",
				 required : "는(은) 필수 입력사항입니다.",
				 required_group : "이 항목들 중에 {requirenum}개 이상의 항목이 입력되어야 합니다.",
				 notequal : "입력된 내용이 일치하지 않습니다.",
				 invalid  : "입력된 내용이 형식에 어긋납니다.",
				 minbyte  : "입력된 내용의 길이가 {minbyte}Byte 이상이어야 합니다.",
				 maxbyte  : "입력된 내용의 길이가 {maxbyte}Byte를 초과할 수 없습니다.",
				 limitbyte  : "입력된 내용의 길이가 {minbyte}~{maxbyte}Byte 이여야 합니다."
			}
			// 폼 체크 함수 매핑
			this.VALIDATE_FUNCTION = {
				 email   : this.func_isValidEmail,
				 phone   : this.func_isValidPhone,
				 userid  : this.func_isValidUserid,
				 hangul  : this.func_hasHangul,
				 number  : this.func_isNumeric,
				 engonly : this.func_alphaOnly,
				 hanonly : this.func_hanOnly,
				 jumin   : this.func_isValidJumin,
				 bizno   : this.func_isValidBizNo,
				 nick   : this.func_isValidNickName
			}
			/**
			* 에러 출력 플래그
			* all : 1, one : 2, one per object : 3
			*/
			this.ERROR_MODE = 2;
	
			for (var i=0,s=document.forms.length; i<s; i++) {
					var form = document.forms[i];
					form.getValue = function(elName) {
							var el = this.elements[elName];
							var ret = new Array();
							if (typeof el == 'undefined') {
									return null;
							} else if (typeof el.length != 'undefined') {
									if (el.type == 'select-one') {
											return el.options[el.selectedIndex].value;
									} else {
											for (var j=0,t=el.length; j<t; j++) {
													if (el[j].checked) {
															if (el[j].getAttribute('TYPE') == 'radio') return el[j].value;
															if (el[j].getAttribute('TYPE') == 'checkbox') ret[ret.length] = el[j].value;
													}
											}
											return ret;
									}
									return null;
							} else {
									return el.value;
							}
							return null;
					}
					form.setValue = function(elName, value) {
							var el = this.elements[elName];
							if (typeof el.length != 'undefined') {
									if (el.type == 'select-one') {
											for (var j=0,t=el.length; j<t; j++) {
													if (el.options[j].value == value)
															el.selectedIndex = j;
											}
									} else {
											for (var j=0,t=el.length; j<t; j++) {
													if (el[j].getAttribute('TYPE') == 'radio')
															if (el[j].value == value) el[j].checked = true;
													if (el[j].getAttribute('TYPE') == 'checkbox') {
															if (value.length != undefined) {
																	for (var k=0,cnt=value.length; k<cnt; j++)
																			el[j].checked = (el[j].value == value[k]);
															} else {
																	el[j].checked = (el[j].value == value);
															}
													}
											}
									}
							} else if (typeof el != 'undefined') {
									el.value = value;
							}
					}
					if (form.getAttribute("VALIDATE") !== null) {
							form.submitAction = form.onsubmit;
							form.onsubmit = function() {
									if(typeof this.submitAction != 'undefined') this.submitAction();
									try {
											return classObj.validate(this);
									} catch (e) {
											alert(e);
											return false;
									}
							}
					}
	
					//==-- 기본값 세팅 --==//
					var fl_values = typeof form.values == 'object' ? true : false;
					for (var e = 0; e < form.elements.length; e++) {
							var el = form.elements[e];
							if (fl_values) {
									if (!this.isValidateElement(el)) continue;
									var key = el.name.replace(/\[\]$/,'');
									var value = form.values[key];
									if (value) form.setValue(el.name,value);
							}
							if (el.getAttribute("HNAME") == null || el.getAttribute("HNAME") == "")
									el.setAttribute("HNAME", el.getAttribute("NAME"));
					}
			}
	}
	
	FormChecker.prototype.isValidateElement = function(el) {
			return (el.tagName.toLowerCase() == "fieldset" || el.tagName.toLowerCase() == "object" ||
					el.name == null || el.name == "")
					? false : true;
	}
	
	FormChecker.prototype.validate = function(form) {
			this.isErr      = false;
			this.errMsg     = this.FORM_ERROR_MSG["common"] ? this.FORM_ERROR_MSG["common"] + "\n\n" : "";
			this.errObj     = null;
			this.curObj     = null;
	
			var old_required = new Array;
			for (var i=0, s=form.elements.length; i<s; i++) {
					var el = form.elements[i];
					if (!this.isValidateElement(el)) continue;
	
					var required   = el.getAttribute("REQUIRED");
					var requirenum = el.getAttribute("REQUIRENUM");
					var trim    = el.getAttribute("TRIM");
					var minbyte = el.getAttribute("MINBYTE");
					var maxbyte = el.getAttribute("MAXBYTE");
					var option  = el.getAttribute("OPTION");
					var match   = el.getAttribute("MATCH");
					var span    = el.getAttribute("SPAN");
					var glue    = el.getAttribute("GLUE");
					var pattern = el.getAttribute("PATTERN");
					var elValue = el.value;
//					var elValue = form.getValue(el.name);
	
					if (el.type.toLowerCase() == "radio" || el.type.toLowerCase() == "checkbox") {
							var elType = "check";
					} else if (el.type.toLowerCase() == "file") {
							var elType = "file";
					} else if (el.tagName.toLowerCase() == "select") {
							var elType = "select";
					} else if (el.tagName.toLowerCase() == "input" || el.tagName.toLowerCase() == "textarea") {
							var elType = "text";
					}
					if (elType == "text") {
							switch (trim) {
									case "ltrim": el.value = elValue.ltrim(); break;
									case "rtrim": el.value = elValue.rtrim(); break;
									case "notrim": break;
									default:      el.value = elValue.trim();  break;
							}
					}
					if (required !== null) {
							if (required == "") {
									if (elValue == null || elValue == "")
											this.addError(el,"required");
							} else {
									var fl_old_required = false;
									for (var j=0; j<old_required.length; j++)
											if (old_required[j] == required) fl_old_required = true;
	
									if (!fl_old_required) {
											old_required[old_required.length] = required;
											var reqNum = 0;
											var reqHname = new Array;
											for (var j=0; j<s; j++) {
													var reqEl = form.elements[j];
													if (!this.isValidateElement(reqEl)) continue;
													if (reqEl.getAttribute("REQUIRED") == required) {
															var reqElName = form.getValue(reqEl.name);
															if (reqElName != "" && reqElName != null) reqNum++;
															if (reqHname.join(",").indexOf(reqEl.getAttribute("HNAME")) == -1) 
																reqHname[reqHname.length] = reqEl.getAttribute("HNAME");
													}
											}
											if (reqNum < requirenum) {
													this.addError(el,"required_group",reqHname.join(", "));
											}
									}
							}
					}
					if (elType == "text") {
							if (elValue !== null && elValue != "") {
								if (minbyte != null && maxbyte != null) {
										if (elValue.bytes() < parseInt(minbyte,10) ||
												elValue.bytes() > parseInt(maxbyte,10)) this.addError(el,"limitbyte");
								} else if (minbyte != null) {
										if (elValue.bytes() < parseInt(minbyte,10)) this.addError(el,"minbyte");
								} else if (maxbyte != null) {
										if (elValue.bytes() > parseInt(maxbyte,10)) this.addError(el,"maxbyte");
								}
							}
							if (match != null) {
									if (typeof form.elements[match] == 'undefined')
											throw "Element '"+ match +"' is not found.";
									else if (elValue != form.elements[match].value)
											this.addError(el,"notequal");
							}
							if (elValue != "" && option !== null) {
									if (typeof this.VALIDATE_FUNCTION[option] == 'undefined') {
											throw "Function map '"+ option +"' is not found.";
									} else if (span !== null) {
											var _value = new Array();
											for (var j = 0; j < span; j++) {
													if (typeof form.elements[i+j] == 'undefined')
															throw (i+j) +"th Element is not found.";
													_value[j] = form.elements[i+j].value;
											}
											var value = _value.join(glue === null ? "" : glue);
											var tmp_msg = this.VALIDATE_FUNCTION[option](el, value);
											if (tmp_msg !== true) this.addError(el,tmp_msg);
									} else {
											var tmp_msg = this.VALIDATE_FUNCTION[option](el);
											if (tmp_msg !== true) this.addError(el,tmp_msg);
									}
							}
							if (elValue != "" && pattern !== null) {
									try {
											pattern = new RegExp(pattern);
									} catch (e) {
											throw "Invaild Regular Expression '"+ pattern +"'";
									}
									if (!pattern.test(elValue)) this.addError(el,'invalid');
							}
					}
			}
			if (this.isErr == true) {
					alert(this.errMsg);
					if (this.errObj.getAttribute("delete") !== null)
							this.errObj.value = "";
					if (this.errObj.getAttribute("select") !== null)
							this.errObj.select();
					if (this.errObj.getAttribute("nofocus") === null)
							this.errObj.focus();
			}
			return !this.isErr;
	}
	
	FormChecker.prototype.addError = function(el, type, elName) {
			var pattern = /\{([a-zA-Z0-9_]+)\}/i;
			var msg = (this.FORM_ERROR_MSG[type]) ? this.FORM_ERROR_MSG[type] : type;
			var elName = elName ? elName : el.getAttribute("hname");
	
			if (el.getAttribute("errmsg") != null) msg = el.getAttribute("errmsg");
	
			if (pattern.test(msg) == true) {
					while (pattern.exec(msg)) msg = msg.replace(pattern, el.getAttribute(RegExp.$1));
			}
			if (!this.errObj || this.ERROR_MODE != 2) {
					if (this.curObj == el && el.getAttribute("errmsg") == null) {
							if (this.ERROR_MODE == 1)
									this.errMsg += "   - "+ msg +"\n";
					} else if (this.curObj != el) {
							if (this.curObj)
									this.errMsg += "\n";
//							this.errMsg += "["+ elName +"]\n   - "+ msg +"\n";
							this.errMsg += elName + msg;
					}
			}
			if (!this.errObj) this.errObj = el;
			this.curObj = el;
			this.isErr  = true;
			return;
	}
	
	/// 패턴 검사 함수들 ///
	FormChecker.prototype.func_isValidEmail = function(el,value) {
		 var value = value ? value : el.value;
		 var pattern = /^[_a-zA-Z0-9-\.]+@[\.a-zA-Z0-9-]+\.[a-zA-Z]+$/;
		 return (pattern.test(value)) ? true : "이메일 주소 형식이 틀립니다.";
	}
	
	FormChecker.prototype.func_isValidUserid = function(el) {
//		 var pattern = /^[a-zA-Z]{1}[a-zA-Z0-9_]{4,11}$/;
//		 return (pattern.test(el.value)) ? true : "5자이상 12자 미만,\n 영문,숫자, _ 문자만 사용할 수 있습니다";

		 var pattern = /^[가-힝a-zA-Z0-9]{1}[가-힝a-zA-Z0-9_-]{2,11}$/;
		 // 3~12자의 한글,영문자,숫자,"-","_" 만 가능합니다.
		 // 단 "-"나 "_" 는 첫문자로 사용할 수 없습니다.
		 return (pattern.test(el.value)) ? true : "invalid";
	}
		
	FormChecker.prototype.func_isValidNickName = function(el) {
		 var pattern = /^[가-힝a-zA-Z0-9_-]{2,12}$/;
		 // 2~12자의 한글,영문자,숫자,"-","_" 만 가능합니다.
		 return (pattern.test(el.value)) ? true : "invalid";
	}
	
	FormChecker.prototype.func_hasHangul = function(el) {
		 var pattern = /[가-힝]/;
		 return (pattern.test(el.value)) ? true : "한글을 포함해야 합니다";
	}
	
	FormChecker.prototype.func_alphaOnly = function(el) {
		 var pattern = /^[a-zA-Z]+$/;
		 return (pattern.test(el.value)) ? true : "영문자로만 입력해야 합니다";
	}
	
	FormChecker.prototype.func_hanOnly = function(el) {
		 var pattern = /^[가-힝]+$/;
		 return (pattern.test(el.value)) ? true : "한글로만 입력해야 합니다";
	}
	
	FormChecker.prototype.func_isNumeric = function(el) {
		 var pattern = /^[0-9]+$/;
		 return (pattern.test(el.value)) ? true : "숫자로만 입력해야 합니다";
	}
	
	FormChecker.prototype.func_isValidJumin = function(el,value) {
			var pattern = /^([0-9]{6})-?([0-9]{7})$/;
			var num = value ? value : el.value;
			if (!pattern.test(num)) return "invalid";
			num = RegExp.$1 + RegExp.$2;
	
			var sum = 0;
			var last = num.charCodeAt(12) - 0x30;
			var bases = "234567892345";
			for (var i=0; i<12; i++) {
					if (isNaN(num.substring(i,i+1))) return "invalid";
					sum += (num.charCodeAt(i) - 0x30) * (bases.charCodeAt(i) - 0x30);
			}
			var mod = sum % 11;
			return ((11 - mod) % 10 == last) ? true : "invalid";
	}
	
	FormChecker.prototype.func_isValidBizNo = function(el,value) {
			var pattern = /([0-9]{3})-?([0-9]{2})-?([0-9]{5})/;
			var num = value ? value : el.value;
			if (!pattern.test(num)) return "invalid";
			num = RegExp.$1 + RegExp.$2 + RegExp.$3;
			var cVal = 0;
			for (var i=0; i<8; i++) {
					var cKeyNum = parseInt(((_tmp = i % 3) == 0) ? 1 : ( _tmp  == 1 ) ? 3 : 7);
					cVal += (parseFloat(num.substring(i,i+1)) * cKeyNum) % 10;
			}
			var li_temp = parseFloat(num.substring(i,i+1)) * 5 + "0";
			cVal += parseFloat(li_temp.substring(0,1)) + parseFloat(li_temp.substring(1,2));
			return (parseInt(num.substring(9,10)) == 10-(cVal % 10)%10) ? true : "invalid";
	}
	
	FormChecker.prototype.func_isValidPhone = function(el,value) {
			var pattern = /^([0]{1}[0-9]{1,2})-?([1-9]{1}[0-9]{2,3})-?([0-9]{4})$/;
			var num = value ? value : el.value;
			if (pattern.exec(num)) {
					if(RegExp.$1 == "010" || RegExp.$1 == "011" || RegExp.$1 == "016" || RegExp.$1 == "017" || RegExp.$1 == "018" || RegExp.$1 == "019") {
							if(!el.getAttribute("span"))
									el.value = RegExp.$1 + "-" + RegExp.$2 + "-" + RegExp.$3;
					}
					return true;
			} else {
					return "invalid";
			}
	}
	
/*
function isValidDomain(el) {
	var pattern = /^.+(\.[a-zA-Z]{2,3})$/;
	return (pattern.test(el.value)) ? true : doError(el,NOT_VALID);
}
*/
/*
function isValidDomain(el,value) {
	var value = value ? value : el.value;
	var pattern = new RegExp("^(http://)?(www\.)?([가-힝a-zA-Z0-9-]+\.[a-zA-Z]{2,3}$)","i");
	if (pattern.test(value)) {
		el.value = RegExp.$3;
		return true;
	} else {
		return doError(el,NOT_VALID);
	}
}
*/	
	
	/**
	* common prototype functions
	*/
	String.prototype.trim = function(str) {
			str = this != window ? this : str;
			return str.ltrim().rtrim();
	}
	
	String.prototype.ltrim = function(str) {
			str = this != window ? this : str;
			return str.replace(/^\s+/g,"");
	}
	
	String.prototype.rtrim = function(str) {
			str = this != window ? this : str;
			return str.replace(/\s+$/g,"");
	}
	
	String.prototype.bytes = function(str) {
			var len = 0;
			str = this != window ? this : str;
			for (j=0; j<str.length; j++) {
					var chr = str.charAt(j);
					len += (chr.charCodeAt() > 128) ? 2 : 1;
			}
			return len;
	}

/*	try {
			FormCheckerLoadAction();
	} catch (e) {
			// null
	}
	FormCheckerObject = new FormChecker;*/
/*
ex

새로 추가된 span기능 및 match 기능 테스트
<form onSubmit="return validate(this)">
	전화번호: <input type="text" size="4" name="phone1" required option="phone" span="3" hname="전화번호"> - <input type="text" size="4" name="phone2"> - <input type="text" size="4" name="phone3">
	<br>
	이메일: <input type="text" size="12" name="email1" hname="이메일" required option="email" span="2" glue="@">@<input type="text" name="email2"><br>
	패스워드: <input type="password" name="passwd" match="passwd2" hname="패스워드" required> 확인: <input type="password" name="passwd2"><br>
	도메인주소: http://www.<input type="text" name="domain" hname="도메인" required option="domain"><br>
	<input type="submit" value="테스트">
</form>
<script src="/js/lib.validate.js"></script>
</body> */

}
