<?php
namespace App\Models;

use App\Models\BaseModel;

class Schedule extends BaseModel
{
    protected $table = 'schedule';
    protected $guarded = array("id");

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
