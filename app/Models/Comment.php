<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['board_id', 'content', 'author'];

    public $timestamps = true; // 기본값 true
    const UPDATED_AT = null;   // updated_at 사용 안함
}
