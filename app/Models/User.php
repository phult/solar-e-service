<?php
namespace App\Models;

use App\Models\BaseModel;

class User extends BaseModel
{
    protected $table = 'user';
    protected $guarded = array("id");
    public function messages()
    {
        return $this->hasMany('App\Models\Schedule', 'user_id', 'id');
    }
}
