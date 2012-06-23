	/* =================================================================
	//	참    조: 가운데 팝업창 띄우기
	//	작 성 일: 2006.05.01
	//  출    처: PHPSCHOOL [ID: sjsjin]
	================================================================= */

	var x,y;
	if (self.innerHeight) {
		x = (screen.availWidth - self.innerWidth)/2;
		y = (screen.availHeight - self.innerHeight)/2;
	}
	else if (document.documentElement && document.documentElement.clientHeight) {
		x = (screen.availWidth - document.documentElement.clientWidth)/2;
		y = (screen.availHeight - document.documentElement.clientHeight)/2;
	}
	else if (document.body) {
		x = (screen.availWidth - document.body.clientWidth)/2;
		y = (screen.availHeight - document.body.clientHeight)/2;
	} 
	window.moveTo(x,y);
