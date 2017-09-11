<?php
require_once 'vendor/autoload.php';
use WindowsAzure\Common\ServicesBuilder;
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;
use MicrosoftAzure\Storage\Common\ServiceException;

class Blob
{
//function used to create new containers
  public function newContainer()
  {
      $conn="DefaultEndpointsProtocol=https;AccountName=phblobtest;AccountKey=5UV0NfyNudR3xKN+Q1ONDbp5e2Gool1E/fRI/HHGRXHeWvGJpwelYGE+F2xyVLNZ34USjREWDu2km1PuvxTQuw==";
      $blobRestProxy = ServicesBuilder::getInstance()->createBlobService($conn);
      $createContainerOptions = new CreateContainerOptions();
      $createContainerOptions->setPublicAccess(PublicAccessType::CONTAINER_AND_BLOBS);

    try
    {
    $blobRestProxy->createContainer("mycontainer", $createContainerOptions);
    }

    catch(ServiceException $e)
    {
      $code = $e->getCode();
      $error_message = $e->getMessage();
      echo $code.": ".$error_message."<br />";
    }
    return "Container created";
  }

//Function used to create new blobs for storage
  function newBlob($name)
  {
    $conn="DefaultEndpointsProtocol=https;AccountName=phblobtest;AccountKey=5UV0NfyNudR3xKN+Q1ONDbp5e2Gool1E/fRI/HHGRXHeWvGJpwelYGE+F2xyVLNZ34USjREWDu2km1PuvxTQuw==";
    $blobRestProxy = ServicesBuilder::getInstance()->createBlobService($conn);
    //Open image that was recently uploaded
    $content = fopen("Pictures/$name", "r");
    //Set blob name to same as the image
    $blob_name = $name;
    try
    {
      $blobRestProxy->createBlockBlob("mycontainer", $blob_name, $content);
    }
    catch(ServiceException $e)
    {
      $code = $e->getCode();
      $error_message = $e->getMessage();
      echo $code.": ".$error_message."<br />";
    }
  }

  //upload json data to blob
  function JData($username,$data)
  {
    $conn="DefaultEndpointsProtocol=https;AccountName=phblobtest;AccountKey=5UV0NfyNudR3xKN+Q1ONDbp5e2Gool1E/fRI/HHGRXHeWvGJpwelYGE+F2xyVLNZ34USjREWDu2km1PuvxTQuw==";
    $blobRestProxy = ServicesBuilder::getInstance()->createBlobService($conn);
    $content = $data;
    $blob_name = $username;
    try
    {
      $blobRestProxy->createBlockBlob("mycontainer", $blob_name, $content);
    }
    catch(ServiceException $e)
    {
      $code = $e->getCode();
      $error_message = $e->getMessage();
      echo $code.": ".$error_message."<br />";
    }
  }



}
?>
