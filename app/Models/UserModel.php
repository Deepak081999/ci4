<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 'users';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['name', 'email', 'profile_img', 'password', 'created_at', 'updated_at']; // Ensure timestamps are included

    // Enable automatic timestamps
    protected $useTimestamps  = true;
    protected $createdField   = 'created_at';
    protected $updatedField   = 'updated_at';
    protected $deletedField   = 'deleted_at';
    protected $useSoftDeletes = true;

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

}
