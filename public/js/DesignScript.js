function spaceForSecondMenu() {
    let aside = document.getElementById('aside');
    let corps = document.getElementsByClassName('contenuCorps')[0];
    if (aside != null) {
    	if (window.innerWidth < 750) {// ifprincipal menu is in 2 lines (42*3)
    		corps.style.marginTop = "136px";
    	}
    	else{
	        aside.style.top = "100px";
	        corps.style.marginTop = "100px";
    	}
    }
};

function redComments(qtt){
	badComm = document.getElementById('signaledComm');
	smallScreenBadComm = document.getElementById('signaledCommSmallScreen');

	span =document.getElementById('span');
	smallSpan =document.getElementById('smallSpan');

	badComm.style.color = '#f44336';
	span.style.color = '#f44336';
	smallScreenBadComm.style.color = '#f44336';
	smallSpan.style.color = '#f44336';	
	
	span.textContent +=" (" + qtt + ")";
	smallSpan.textContent +=" (" + qtt + ")";

};

window.onload = function() {
	spaceForSecondMenu();
};