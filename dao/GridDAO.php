<?php

require_once WWW_ROOT.'classes'.DIRECTORY_SEPARATOR.'DatabasePDO.php';

class GridDAO
{
    public $pdo;

   public function __construct()
   {
       $this->pdo = DatabasePDO::getInstance();
   }

  public function getPhotosByCodeAndGroupId($code, $groupid)
  {
    $sql = 'SELECT * FROM er_uploadedphotos WHERE code = :code AND group_id = :groupid';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":code", $code);
    $stmt->bindValue(":groupid", $groupid);

    if($stmt-> execute())
    {
       return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
  }

  public function insertGrid($arrGrid)
  {
  }
}