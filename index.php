
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="style.css?ts=<?=time()?>&quot" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<script type="text/javascript">
window.addEventListener('load',
function()
{
  //Renames upload button
  var inputs = document.querySelectorAll( '.inputfile' );
	Array.prototype.forEach.call( inputs, function( input )
	{
		var label	 = input.nextElementSibling,
			labelVal = label.innerHTML;

		input.addEventListener( 'change', function( e )
		{
			var fileName = '';
			if( this.files && this.files.length > 1 )
				fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
			else
				fileName = e.target.value.split( '\\' ).pop();

			if( fileName )
				label.querySelector( 'span' ).innerHTML = fileName;
			else
				label.innerHTML = labelVal;
		});

	});

  }, false);

</script>

<title>Image Upload</title>
</head>
<body id="body">
  <div class="container-fluid">
  <div class="row">

      <div class="col-xs-12 col-md-12 top">
        <h1>Image Upload</h2>
      </div>
  </div>
  </div>
  <div class="container-fluid">
  <div class="row">

      <div class="col-xs-12 col-md-4">
      </div>
      <div class="col-xs-12 col-md-4 mid">


          <form id="myform" action="upload.php" method="post" enctype="multipart/form-data">
          <input type="file" name="fileToUpload" id="file" class="inputfile" data-multiple-caption="{count} files selected" multiple />
          <label for="file"><span>Choose a file</span></label>
            <br>
            <span class="text">Name</span>
            <br>
          <input type="text" name="name" value="" class="input">
            <br>
            <span class="text">Address</span>
            <br>
          <input type="text" name="address" value="" class="input">
            <br>
            <span class="text">County</span>
            <br>
          <input type="text" name="county" value="" class="input">
            <br>
            <span class="text">Country</span>
            <br>
          <input type="text" name="country" value="" class="input">
            <br>
            <span class="text">Phone Number</span>
            <br>
          <input type="number" name="number" value="" class="input">
            <br>
            <span class="text">Date Of Birth</span>
            <br>
          <input type="date" name="dob" value="" class="input">
            <br>
          <input type="submit" value="Upload" name="submit" id="up">
        </form>

      </div>
      <div class="col-xs-12 col-md-4">
      </div>

  </div>
  </div>


</body>



</html>
