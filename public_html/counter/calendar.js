	var layerName;
	var bodyCode;

	var DOMonth = [31,28,31,30,31,30,31,31,30,31,30,31];
	var lDOMonth = [31,29,31,30,31,30,31,31,30,31,30,31];
	var day_header = ["��", "��", "ȭ", "��", "��", "��", "��"];
	
	var gNow = new Date();
	var today = new Date();

	var ret_name;

	function getXY(Obj) {
		for (var sumTop=0,sumLeft=0;Obj!=document.body;sumTop+=Obj.offsetTop,sumLeft+=Obj.offsetLeft, Obj=Obj.offsetParent);
		return {left:sumLeft,top:sumTop}
	}

	function clickon(day){
		var mon = (gNow.getMonth()+1).toString();
		var dat = day.toString();
		var retval;
		retval = gNow.getFullYear().toString()+"-"
		retval += (mon.length < 2? "0" + mon:mon)+"-";
		retval += (dat.length < 2? "0" + dat:dat);
		if(ret_name != null) ret_name.value = retval;
		hide();
		if(typeof(ret_function)=='function') ret_function();
	}

	function get_day_of_month(monthNo, p_year){
		if(monthNo == -1) {
			monthNo = 11;
			p_year--;
		} else if(monthNo == 12) {
			monthNo = 0;
			p_year++;
		}
	
		if ((p_year % 4) == 0) {
			if ((p_year % 100) == 0 && (p_year % 400) != 0) return Calendar.DOMonth[monthNo];
			return lDOMonth[monthNo];
		} else return DOMonth[monthNo];
	}

	function get_dow_of_mfirst(monthNo, p_year){
		if(monthNo == -1) {
			monthNo = 11;
			p_year--;
		} else if(monthNo == 12) {
			monthNo = 0;
			p_year++;
		}

		var vDate = new Date();
		vDate.setDate(1);
		vDate.setMonth(monthNo);
		vDate.setFullYear(p_year);
		return vDate.getDay();
	}

	function makeDay(sel, day, thrd, curday){
		var colorCode = "";
		bodyCode += "<td";
		if(thrd < 0 || thrd > 6) {
			bodyCode += " style='COLOR: gray;'>" + day + "</td>";
		} else {
			if(day == curday){ // ����
				colorCode = " COLOR: #C000C0;";
			} else {
				if(sel == 0) // �Ͽ���
					colorCode = " COLOR: #C00000;";
				else if(sel == 6) // �����
					colorCode = " COLOR: #0000C0;";
				else
					colorCode = " COLOR: #000000;";
			}
			bodyCode += ">";
			bodyCode += "<a href=\"javascript:clickon('"+day+"');\" style='TEXT-DECORATION: none; " + colorCode + "'>";
			bodyCode += day;
			bodyCode += "</a>";
			bodyCode += "</td>";
		}
	}
	
	function makeWeek(startD, thrd){
		var startDay = startD;
		var cur_date = -1;
		var i;

		if(gNow.getFullYear() == today.getFullYear() && gNow.getMonth() == today.getMonth())
			cur_date = today.getDate();
		
		bodyCode += "<tr align=center>";

		if(thrd < 0) {  // ù��° �� 
			startDay = get_day_of_month(gNow.getMonth()-1, gNow.getFullYear()) + thrd + 1;
			for(i=0; i<7; i++, startDay++, thrd++) {
				if(startDay > get_day_of_month(gNow.getMonth()-1, gNow.getFullYear()) ) startDay = 1;
				makeDay(i, startDay, thrd, cur_date);
			}
		} else if(thrd > 0 && thrd < 7) { // ������ ��
			for(i=0; i<7; i++, startDay++, thrd++) {
				if(startDay > get_day_of_month(gNow.getMonth(), gNow.getFullYear())) startDay = 1;
				makeDay(i, startDay, thrd, cur_date);
			}
		} else {
			for(i=0; i<7; i++, startDay++, thrd++) {
				makeDay(i, startDay, thrd, cur_date);
			}
		}
 		bodyCode += "</tr>"
		return startDay;
	}
	
	function makebody(){
		var startDay;
		startDay = makeWeek(1, 0-get_dow_of_mfirst(gNow.getMonth(), gNow.getFullYear()));

		while(startDay < (get_day_of_month(gNow.getMonth(), gNow.getFullYear())-6)) {
			startDay = makeWeek(startDay, 0);
		}
		startDay = makeWeek(startDay, (7-get_dow_of_mfirst(gNow.getMonth()+1, gNow.getFullYear()))%7);
	}

	function makeCal(){
		var i, startDay;
		bodyCode = "<table width=160 BORDER=0 CELLPADDING=0 BGCOLOR='#CCCCCC'>";
		bodyCode += "  <tr>";
		bodyCode += "    <td>";
		bodyCode += "      <table width=100% style='FONT-SIZE: 12px; FONT-FAMILY: Gulim, AppleGothic, Seoul'>";
		bodyCode += "        <tr align=center>";
		bodyCode += "          <td width=20%> <a href=\"javascript:changeCal("+ (gNow.getMonth()) +","+ gNow.getFullYear() +");\" style='COLOR: #000066; TEXT-DECORATION: none'>��</a> </td>";
		bodyCode += "          <td width=60%><b> " + gNow.getFullYear() + "�� " + (gNow.getMonth() + 1) + "�� </b></td>";
		bodyCode += "          <td width=20%> <a href=\"javascript:changeCal("+ (gNow.getMonth() + 2) +","+ gNow.getFullYear() +");\" style='COLOR: #000066; TEXT-DECORATION: none'>��</a> </td>";
		bodyCode += "        </tr>";
		bodyCode += "        <tr>";
		bodyCode += "          <td colspan=3>";
		bodyCode += "            <table bgcolor=white width=100% style='FONT-SIZE: 12px; FONT-FAMILY: Gulim, AppleGothic, Seoul'>";
		bodyCode += "              <tr align=center>";
		bodyCode += "                <td style='color: #C00000'> �� </td>";
		bodyCode += "                <td style='color: #000000'> �� </td>";
		bodyCode += "                <td style='color: #000000'> ȭ </td>";
		bodyCode += "                <td style='color: #000000'> �� </td>";
		bodyCode += "                <td style='color: #000000'> �� </td>";
		bodyCode += "                <td style='color: #000000'> �� </td>";
		bodyCode += "                <td style='color: #0000C0'> �� </td>";
		bodyCode += "              </tr>";
		bodyCode += "              <tr height=1>";
		bodyCode += "                <td colspan=7 bgcolor='#555555'></td>";
		bodyCode += "              </tr>";

		makebody();
		
		bodyCode += "            </table>";
		bodyCode += "          </td>";
		bodyCode += "        </tr>";
		bodyCode += "        <tr align=center>";
		bodyCode += "          <td colspan=3> ���� : " + (today.getMonth() + 1) +"�� " + today.getDate() + "�� " + day_header[today.getDay()] + "����</td>";
		bodyCode += "        </tr>";
		bodyCode += "        <tr align=center>";
		bodyCode += "          <td colspan=3> <b><a href='javascript:hide();' style='COLOR: #000066; TEXT-DECORATION: none'> [�ݱ�] </a></b> </td>";
		bodyCode += "        </tr>";
		bodyCode += "      </table>";
		bodyCode += "    </td>";
		bodyCode += "  </tr>";
		bodyCode += "</table>";
	}

	function changeCal2(year_month){ // yyyy-mm-dd
		if(year_month != null) {
			year_month=year_month.split("-")
			s_year=Number(year_month[0])
			s_mon=Number(year_month[1])
			if(!isNaN(s_year) && !isNaN(s_mon)) {
				changeCal(s_mon, s_year)
			} else {
				changeCal()
			}
		}
	}
	
	function changeCal(s_mon, s_year){
		if(s_mon != null && s_year != null ) {
			if(s_mon == 0) {
				s_mon = 12;
				s_year--;
			} else if(s_mon == 13) {
				s_mon = 1;
				s_year++;
			}
			gNow.setMonth(s_mon-1);
			gNow.setFullYear(s_year);
		}
		makeCal();
		document.all[layerName].innerHTML = bodyCode;
	}

	function showXY(location){
		var X, Y;
		X = getXY(location).left;
		Y = getXY(location).top + 20;
		document.all[layerName].style.left = X;
		document.all[layerName].style.top = Y;
		changeCal();
	}
	
	function hide(){
		document.all[layerName].innerHTML = "";
	}

	function createLayer(Lname){
		layerName = Lname;
		document.write("<DIV ID="+ Lname +" STYLE='position:absolute;top:10;left:15;z-index=4'></DIV>");
	}
