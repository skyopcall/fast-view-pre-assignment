<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Validators\BoardValidator;

class CommentController extends Controller
{
    public function __construct()
    {
        // 부모 데이터 가져오기
        parent::__construct();
    }

    
    // 게시글에 대한 코맨트 리스트 가져오기
    public function index($boardId)
    {
        $board = Board::find($boardId);
        if (!$board) {
            return $this->sendErrorResult( '게시글을 찾을 수 없습니다.', 404);
        }

        $comments = $board->comments()->get();
        
        $this->setReturnData('comments', $comments);
        $this->sendResult();
    }

}
