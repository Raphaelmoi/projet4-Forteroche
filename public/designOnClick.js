
function redHearth(value, like){
	let redHearthOrNot = document.getElementById('redHearth');

		if (like == null) {
			like = 0;
		}
		if (like == 0) {
			redHearthOrNot.style.color = '#333';
		}
		else{
			redHearthOrNot.style.color = 'red';
		}
		console.log('like');
/*		window.open('index.php?action=addonelike&like='+ like +'&id=' + value, '_self' );
*/}
