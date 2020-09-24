<?php 
error_reporting(E_ALL);
session_start();
if($_SESSION['UserId']!="")
{

        $uname = $_SESSION['Name'];
        include_once("CommonUtilities/Connections.php");
        include_once "CommonUtilities/Functions.php";
        
        $data1 = array();  
       // echo $_FILES["file"]["name"];
       // echo $_FILES["file2"]["name"];
    if(!empty($_FILES))  
    { 
	    $upload_dir = "Files/";
	    $upload_dir2 = "Files/";
	    $upload_dir3 = "Files/";
	    $upload_dir4 = "Files/";
	    $upload_dir5 = "Files/";
		if(isset($_FILES["file"]["type"]))
		{
			$temporary = explode(".", $_FILES["file"]["name"]);
			$file_extension = end($temporary);
			
			$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
			$filename = rand().$_FILES['file']['name'];
			$targetPath = $upload_dir.$filename; // Target path where file is to be stored
			move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
		//	echo $filename;
			//array_push($data, $targetPath);
			//echo json_encode($data1);
		}
		else
		{
		   echo "Invalid File1";
		}
		
		if (isset($_FILES["file2"]["type"])) 
		{

			$temporary = explode(".", $_FILES["file2"]["name"]);
			$file_extension = end($temporary);
			
			$sourcePath = $_FILES['file2']['tmp_name']; // Storing source path of the file in a variable
			$filename2 = rand().$_FILES['file2']['name'];
			$targetPath = $upload_dir2.$filename2; // Target path where file is to be stored
			move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
		//	echo $filename2;
		}
		else
		{
		   echo "Invalid File2";
		}
		
		if (isset($_FILES["file3"]["type"])) 
		{

		    $temporary = explode(".", $_FILES["file3"]["name"]);
			$file_extension = end($temporary);
			
			$sourcePath = $_FILES['file3']['tmp_name']; // Storing source path of the file in a variable
			$filename3 = rand().$_FILES['file3']['name'];
			$targetPath = $upload_dir3.$filename3; // Target path where file is to be stored
			move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
		//	echo $filename3;
		}
		else
		{
		   echo "Invalid File3";
		}

		if (isset($_FILES["file4"]["type"])) 
		{

			$temporary = explode(".", $_FILES["file4"]["name"]);
			$file_extension = end($temporary);
			
			$sourcePath = $_FILES['file4']['tmp_name']; // Storing source path of the file in a variable
			$filename4 = rand().$_FILES['file4']['name'];
			$targetPath = $upload_dir4.$filename3; // Target path where file is to be stored
			move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
		//	echo $filename4;
		}
		else
		{
		//	echo "Invalid File4";
		}

		if (isset($_FILES["file5"]["type"])) {

			$temporary = explode(".", $_FILES["file5"]["name"]);
			$file_extension = end($temporary);
			
			$sourcePath = $_FILES['file5']['tmp_name']; // Storing source path of the file in a variable
			$filename5 = rand().$_FILES['file5']['name'];
			$targetPath = $upload_dir5.$filename5; // Target path where file is to be stored
			move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
		//	echo $filename5;
		}
		else
		{
			echo "Invalid File5";
		}

		$data1 = array("File1"=>$filename,"File2"=>$filename2,"File3"=>$filename3,"File4"=>$filename4,"File5"=>$filename5);
		echo (json_encode($data1));
    }
	else
	{
	   echo "No file selected";
	}
	//$paths = trim($paths, ", ,");
	//echo $paths;


}
else
{ 
  echo "<script language=\"javascript\">window.location=\"index.php\";</script>";
}
?>
