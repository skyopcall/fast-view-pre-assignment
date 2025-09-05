<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['board_id', 'content', 'author'];

     // updated_at 자동 관리 비활성화
    public $timestamps = false;
}
