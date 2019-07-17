tinymce.activeEditor.uploadImages(function(success) {
  $.post('ajax/post.php', tinymce.activeEditor.getContent()).done(function() {
	console.log("Uploaded images and posted content as an ajax request.");
  });
});
