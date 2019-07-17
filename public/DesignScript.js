
function spaceForSecondMenu() {
    let aside = document.getElementById('aside');
    let corps = document.getElementsByClassName('contenuCorps')[0];
    if (aside != null) {
        aside.style.top = "100px";
        corps.style.marginTop = "100px";
    }
};
spaceForSecondMenu();

