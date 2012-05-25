<p>
	<SCRIPT LANGUAGE="JavaScript">
	// Set the BaseURL to the URL of your camera
	var BaseURL = "http://<?php echo $model->ip ?>/";
	
	// DisplayWidth & DisplayHeight specifies the displayed width & height of the image.
	// You may change these numbers, the effect will be a stretched or a shrunk image
	var DisplayWidth = "480";
	var DisplayHeight = "360";
	
	// This is the path to the image generating file inside the camera itself
	var File = "axis-cgi/jpg/image.cgi?resolution=480x360";
	
	// Force an immediate image load
	var theTimer = setTimeout('reloadImage()', 1);
	
	function reloadImage()
	{
	  theDate = new Date();
	  var url = BaseURL;
	  url += File;
	  url += '&dummy=' + theDate.getTime().toString(10);
	  // The dummy above enforces a bypass of the browser image cache
	  // Here we load the image
	  document.theImage.src = url;
	
	  // Reload the image every ten seconds (10000 ms)
	  theTimer = setTimeout('reloadImage()', 10000);
	}
	document.write('<img name="theImage" src="" height="' + DisplayHeight + '"');
	document.write('width="' + DisplayWidth + '" alt="Live image">');
	</SCRIPT>
</p>