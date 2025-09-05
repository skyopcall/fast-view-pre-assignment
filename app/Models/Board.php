<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'create_user'];

     // updated_at 자동 관리 비활성화
    public $timestamps = false;

}
