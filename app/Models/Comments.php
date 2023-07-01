<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\app\Models\User;
class Comments extends Model
{
    use HasFactory;

    protected $table = "comments";

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
