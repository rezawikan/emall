<?php

namespace Emall\Files;

use Emall\Files\FileUploader;

class ImagesProfile extends FileUploader
{
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

 protected $conn;

 public function uploadImageProfile()
 {
   $this->setDestination();
   $this->dataImage = $this->getImageNameProfile();
   $this->saveToSeller();
   $this->DeletePrevImage();
   $this->MoveFiles();
   $this->flush();
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
}
 ?>
