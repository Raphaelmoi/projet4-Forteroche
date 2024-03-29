//configuration of tinyMCE
tinymce.init({
	selector:'textarea',
    plugins: [
      'autosave advlist code autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor image'
    ],
    toolbar: ['insertfile undo redo|styleselect| bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | forecolor backcolor emoticons || preview  fullpage fullscreen restoredraft'],
    autosave_interval: "20s",

  	paste_data_images: true,
  	 /* without images_upload_url set, Upload tab won't show up*/
  	images_upload_url: 'index.php?action=addImg',

  /* we override default upload handler to simulate successful upload*/
	images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;
      
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', 'index.php?action=addImg');
      
        xhr.onload = function() {
            var json;
        
            if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }
        	console.log(xhr.responseText);  
          json = JSON.parse(xhr.responseText);
        
            if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }
        
            success(json.location);
        };
      
        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
      
        xhr.send(formData);
    }
});


