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
	span =document.getElementById('span');
	badComm.style.color = '#f44336';
	span.style.color = '#f44336';
	span.textContent +=" (" + qtt + ")";
	span.style.fontWeight = 'normal';
};

window.onload = function() {
	spaceForSecondMenu();
};