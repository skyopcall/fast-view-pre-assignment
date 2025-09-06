<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Comment;
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

    // 댓글 생성
    public function store(Request $request, $boardId)
    {
        $board = Board::find($boardId);
        if (!$board) {
            return $this->sendErrorResult( '게시글을 찾을 수 없습니다.', 404);
        }

        // request 유효성 검사
        $validator = BoardValidator::commentValidate($request->all());
        
        if ($validator->fails()) {
            return $this->sendErrorResult($validator->errors()->first(), 422);
        }

        // 검증된 데이터 가져오기
        $validatedData = $validator->validated();

        $comment = new Comment($validatedData);
        $comment->board_id = $boardId;
        try {
            $comment->save();
        } catch (\Exception $e) {
            $this->setTestReturnData('exception', $e->getMessage());
            return $this->sendErrorResult('코맨트 등록에 실패하였습니다.', 500);
        }

        $this->setReturnData('commentId', $comment->id);
        $this->setReturnData('boardId', $boardId);
        $this->sendResult(201, "등록이 완료되었습니다.");
    }

    // 댓글 수정
    public function update(Request $request, $boardId, $id)
    {
        $comment = Comment::where('board_id', $boardId)->find($id);
        if (!$comment) {
            return $this->sendErrorResult( '댓글을 찾을 수 없습니다.', 404);
        }

        $comment->content = $request->input('content', $comment->content);
        try {
            $comment->save();
        } catch (\Exception $e) {
            $this->setTestReturnData('exception', $e->getMessage());
            return $this->sendErrorResult('코맨트 등록에 실패하였습니다.', 500);
        }

        $this->setTestReturnData('comment', $comment);
        $this->setReturnData('commentId', $comment->id);
        $this->setReturnData('boardId', $boardId);
        return $this->sendResult(200, '수정되었습니다.');
    }

        // 댓글 삭제
    public function destroy($boardId, $id)
    {
        $comment = Comment::where('board_id', $boardId)->find($id);
        if (!$comment) {
             return $this->sendErrorResult( '댓글을 찾을 수 없습니다.', 404);
        }

        try {
            $comment->delete();
        } catch (\Exception $e) {
            $this->setTestReturnData('exception', $e->getMessage());
            return $this->sendErrorResult('코맨트 삭제에 실패하였습니다.', 500);
        }
        return $this->sendResult(200, '삭제되었습니다.');
    }

}
