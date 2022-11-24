<?php 
namespace App\Models;
use CodeIgniter\Model;
class ImageUploadModel extends Model
{
    protected $table      = 'imageupload';
    protected $allowedFields = ['id', 'userid', 'image'];
    protected $primaryKey = 'id';
  
}
?>