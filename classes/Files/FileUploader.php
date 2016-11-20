<?php

namespace Emall\Files;

use Emall\Database\Database;

class FileUploader
{
  protected $conn;

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

  public function flush()
  {
    $this->fileData       = "";
    $this->fileName       = "";
    $this->destination    = "";
    $this->fileDirectory  = "";
    $this->userID         = "";
    $this->dataImage      = "";
    $this->lastIDImage    = "";
  }
}
