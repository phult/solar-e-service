<?php
namespace App\Models;
namespace App\Models\BaseModel;

class User extends BaseModel
{
    protected $table = 'user';
    protected $guarded = array("id");
}
