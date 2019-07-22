//create the src of image for new article or modify article pages, for instant preview
let imageUrl = function(event) {
	var output = document.getElementById('outputImg');
	output.src = URL.createObjectURL(event.target.files[0]);
};