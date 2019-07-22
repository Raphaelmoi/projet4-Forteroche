function spaceForSecondMenu() {
    let aside = document.getElementById('aside');
    let corps = document.getElementsByClassName('contenuCorps')[0];
    if (aside != null) {
        aside.style.top = "100px";
        corps.style.marginTop = "100px";
    }
};
spaceForSecondMenu();

function redComments(qtt){
	badComm = document.getElementById('signaledComm');
	span =document.getElementById('span');
	badComm.style.color = '#f44336';
	span.style.color = '#f44336';
	span.textContent +=" (" + qtt + ")";
	span.style.fontWeight = 'normal';
}