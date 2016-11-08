<?php

namespace Emall\Files;

class FileUploader
{
  private $conn;

  protected $fileData;

  protected $fileName;

  protected $destination;

  protected $fileDirectory;

  protected $userID;

  protected $dataImage;

  protected $table;

  protected $dataFields;

  protected $whereCondition;

  protected $status = 'main';

  protected $lastIDImage;

  public function __construct()
  {
    $this->conn = Database::getInstance();
	}

  public function setUserID($id)
  {
    $this->userID = $id;
  }

  public function setFileData($fileData)
  {
    $this->fileData = $fileData;
  }

  public function setDirectory($directory)
  {
    $this->fileDirectory = $directory;
  }

  protected function setFileName()
  {
    $this->fileName = $this->getFirstName()  . '_' . time()  . '.' .$this->getFileExtension();
  }

  public function getFileName()
  {
    return $this->fileName;
  }

  protected function getFirstName()
  {
    $arr = explode('.', $this->fileData['name']);
    return array_shift($arr);
  }

  protected function getFileExtension()
  {
    return pathinfo($this->fileData['name'],PATHINFO_EXTENSION);
  }

  protected function setDestination()
  {
    $this->setFileName();
    $this->destination = $this->fileDirectory . $this->fileName;
  }

  public function getDestination()
  {
    return $this->destination;
  }

  protected function FileExsist()
  {
    return file_exists($this->fileDirectory . $this->dataImage);
  }

  public function MoveFiles()
  {
    move_uploaded_file($this->fileData['tmp_name'], $this->destination);
  }

  protected function DeletePrevImage()
  {
    if($this->FileExsist() == true) {
      if ($this->dataImage != 'defaults.jpg' && $this->dataImage != null) {
          unlink($this->fileDirectory . $this->dataImage);
          return true;
      }
    }
    return true;
  }

   /*
  * This syntax in below for handle one image only
  * can't use to save some image
  *
  * Step by Step for uploading profile picture
  * 1. use function setDestination() to initialize directory file name with set a new name
  * 2. use function fileNameFromDatabase() to take past path from database and assign to property dataImage
  * 3. use function saveToSeller() save profile image to database
  * 4. use function DeletePrevImage() to delete file from directory with help property dataImage has been set
  * 5. use function MoveFiles() to move file to directory
  */

  public function uploadImageProfile()
  {
    $this->setDestination();
    $this->dataImage = $this->getImageNameProfile();
    $this->saveToSeller();
    $this->DeletePrevImage();
    $this->MoveFiles();
  }

  protected function getImageNameProfile()
  {
    try {
        $user = $this->conn;
        $user->setTable('seller');
        $result = $user->select('image')->where('sellerID','=',$this->userID)->first();
        return $result->image;
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
  }

  public function saveToSeller()
  {
    try {
        $user = $this->conn;
        $user->setTable('seller');
        $user->where('sellerID','=',$this->userID)->update([
          'image' => $this->fileName
        ]);

        return true;
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
  }

  /*
 * This syntax in below for handle multiple images
 *
 * Step by Step for uploading Multiple images product
 * 1. use function setDestination() to initialize directory file name with set a new name
 * 2. use fileNameProduct() to get a file name in order
 * 3. set data image from value that generate by fileNameProduct()
 * 4. use function saveToProduct() to save into database
 * 5. use function DeletePrevImage() to delete file from directory with help property dataImage has been set
 * 6. use function MoveFiles() to move file to directory

 */

 public function uploadImageProduct($lastID,$index)
 {
   $this->setDestination();
   $this->dataImage = $this->fileNameProduct($lastID,$index);
   $this->saveToProduct($lastID);
   $this->DeletePrevImage();
   $this->deleteFromDatabase($this->dataImage);
   $this->MoveFiles();
 }

 public function fileNameProduct($lastID,$index)
 {
   try {
        $user = $this->conn;
        $user->setTable('product_images');
        $result = $user->select('image_name')->where('product_id','=',$lastID)->all();
        foreach ($result as $i => $image) {
          if ($i == $index) {
            return $image->image_name;
         }
       }
   } catch (PDOException $e) {
     echo "Error : ".$e->getMessage();
   }
 }

 public function deleteFromDatabase($ImageName)
 {
   try {
     $user = $this->conn;
     $user->setTable('product_images');
     if($ImageName != null){
       $user->where('image_name','=',$ImageName)->delete();
     }
     return true;
   } catch (Exception $e) {
     echo "Error : ".$e->getMessage();
   }

 }

 public function saveToProduct($lastID)
 {
   try {
       $user = $this->conn;
       $user->setTable('product_images');
       $user->create([
         'image_name' => $this->fileName,
         'product_id' => $lastID,
         'image_path' => $this->destination
       ]);

       $this->lastIDImage = $user->lastID();
   } catch (PDOException $e) {
     echo "Error : ".$e->getMessage();
   }
 }

 public function setMainImage()
 {
   try {
       $user = $this->conn;
       $user->setTable('product_images');
       $user->where('id','=',$this->lastIDImage)->update([
         'status' => $this->status
       ]);
       return true;
   } catch (PDOException $e) {
     echo "Error : ".$e->getMessage();
   }
 }
}
