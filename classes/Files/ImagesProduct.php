<?php

namespace Emall\Files;

use DateTime;
use Emall\Files\FileUploader;

class ImagesProduct extends FileUploader
{
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
 protected $conn;

 public function uploadImageProduct($productID,$index)
 {
   $this->setDestination();
   $this->dataImage = $this->fileNameProduct($productID,$index);
   $this->saveToProduct($productID);
   $this->DeletePrevImage();
   $this->deleteFromDatabase($this->dataImage);
   $this->MoveFiles();
 }

 public function updateImageProduct($productID,$index)
 {
   $this->setDestination();
   $this->dataImage = $this->fileNameProduct($productID,$index);
   $this->DeletePrevImage();
   $this->updateImage($this->dataImage);
   $this->MoveFiles();
 }

 public function updateImage($imageName)
 {
   try {
        $user = $this->conn;
        $user->setTable('product_images');
        $result = $user->where('image_name','=',$imageName)
        ->update([
          'image_name'  => $this->fileName,
          'image_path'   => $this->destination
        ]);

   } catch (PDOException $e) {
     echo "Error : ".$e->getMessage();
   }
 }

 public function deletePrevImageProduct($productID,$index)
 {
   $this->setDirectory('uploads/product/');
   $this->dataImage = $this->fileNameProduct($productID,$index);
   $this->DeletePrevImage();
 }

//99 0
 public function fileNameProduct($productID,$index)
 {
   try {
        $user = $this->conn;
        $user->setTable('product_images');
        $result = $user->select('image_name')->where('product_id','=',$productID)->all();
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

 public function saveToProduct($productID)
 {
   try {
       $user = $this->conn;
       $user->setTable('product_images');
       $user->create([
         'image_name' => $this->fileName,
         'product_id' => $productID,
         'image_path' => $this->destination,
         'create_at'  => date_format(new DateTime(), 'Y-m-d H:i:s')
       ]);

      //  $this->lastIDImage = $user->lastID();
   } catch (PDOException $e) {
     echo "Error : ".$e->getMessage();
   }
 }

 public function setMainImage()
 {
   try {
       $user = $this->conn;
       $user->setTable('product_images');
       $user->where('image_name','=',$this->fileName)->update([
         'status' => $this->status
       ]);
       return true;
   } catch (PDOException $e) {
     echo "Error : ".$e->getMessage();
   }
 }
}
 ?>
