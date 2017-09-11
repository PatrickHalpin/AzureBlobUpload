<?php

include 'blob.php';


$target_dir = "Pictures/";
$name=basename( $_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$username;
$address;
$county;
$country;
$dob;
$number;
$message;
$data;

$blobUrl="https://phblobtest.blob.core.windows.net/mycontainer/".$name;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"]))
{
    //Set variable to input form entries
    $username = $_POST['name'];
    $address = $_POST['address'];
    $county = $_POST['county'];
    $country = $_POST['country'];
    $dob = $_POST['dob'];
    $number = $_POST['number'];

    //Add variables to an array to be converted to json obejct
    $arr = array('Name' => $username, 'Address' => $address, 'County' => $county, 'Country' => $country, 'DOB' => $dob,'Number' => $number,'URL'=>$blobUrl);

    $data =json_encode($arr);


    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false)
    {
        $uploadOk = 1;
    }
    else
    {
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file))
{
    $message= "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0)
{
  $message= "Sorry, your file was not uploaded. Please ensure your file is an image.";
// if everything is ok, try to upload file
}
else
{
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
     {
        $message= basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        //Create new blob instance and upload image to blob
        //upload json object to blob as well
        $blob = new Blob();
        $blob->newBlob($name);
        $blob->JData($username,$data);
    }
    else
    {
        $message= "Sorry, there was an error uploading your file.";
    }
}

?>

<link href="style.css?ts=<?=time()?>&quot" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<html>
<body id="body">
  <div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-md-12 top">
      <h2><?php echo $message ?></h2>
    </div>
  </div>
  </div>
  <div class="container-fluid">
    
  <div class="row">
    <div class="col-xs-12 col-md-12 top">
      <img class="img" src=Pictures/<?php echo $name ?>>
    </div>
  </div>
    <div class="row">
      <div class="col-xs-12 col-md-4">
      </div>
      <div class="col-xs-12 col-md-4 mid head">
        <a href="index.php" class="link" >Upload Another Image</a>

      <h2>Your Details</h2>
      <h3>Name</h3>
      <h4><?php echo $username ?></h4>
      <h3>Address</h3>
      <h4><?php echo $address ?></h4>
      <h3>County</h3>
      <h4><?php echo $county ?></h4>
      <h3>Country</h3>
      <h4><?php echo $country ?></h4>
      <h3>Number</h3>
      <h4><?php echo $number ?></h4>
      <h3>Date Of Birth</h3>
      <h4><?php echo $dob ?></h4>
      <a class="link" href="<?php echo $blobUrl ?>">Image Download</a>
    </div>
    <div class="col-xs-12 col-md-4">
    </div>
  </div>
  </div>






</body>
</html>
