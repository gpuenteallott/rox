var Gallery = {
	imageUploaded: function() {
		if($('gallery-upload-content')) {
			var url = http_baseuri+'gallery/uploaded';
			new Ajax.Updater('gallery-upload-content', url, {method:'get', parameters:'raw=1'});
		}
	}
}