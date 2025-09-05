<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Validators\BoardValidator;

class BbsController extends Controller
{
    public function __construct()
    {
        // 부모 데이터 가져오기
        parent::__construct();
    }

    // 게시판 리스트 조회
    public function index()
    {
        $boardLists = Board::all();
        
        // 만약 response 데이터 변형이 필요 할 시 추가 작업

        $this->setReturnData('boardList', $boardLists);
        $this->sendResult();
    }

    // 게시글 생성
    public function store(Request $request)
    {
        // request 유효성 검사
        $validator = BoardValidator::validate($request->all());
        
        if ($validator->fails()) {
            return $this->sendErrorResult($validator->errors()->first(), 422);
        }
  
        $insertData = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'create_user' => $request->input('createUser'),
        ];
        $board = Board::create($insertData);
        if(!$board){
            return $this->sendErrorResult('게시글 등록에 실패하였습니다.', 500);
        }

        $this->setTestReturnData('boardInfo', $board);
        $this->sendResult(201);
    }

    // 게시글 수정
    public function update(Request $request, $id)
    {
        $board = Board::find($id);
        if (!$board) {
            return $this->sendErrorResult('게시글을 찾을 수 없습니다.', 404);
        }

        $title = $request->input('title');
        $content = $request->input('content');
        $createUser = $request->input('createUser');

        // 값이 빈값이면 처리하지 update 하지 않음
        if (
                (is_null($title) || $board->title === $title) &&
                (is_null($content) || $board->content === $content) &&
                (is_null($createUser) || $board->create_user === $createUser) 
        ) {
            return $this->sendErrorResult('업데이트할 값이 없습니다', 400);
        }
        

        $board->title = $title??$board->title;
        $board->content = $content??$board->content;
        $board->create_user = $createUser??$board->create_user;

        try {
            $board->save();
        } catch (\Exception $e) {
            $this->setTestReturnData('exception', $e->getMessage());
            return $this->sendErrorResult('게시글 수정에 실패하였습니다.', 500);
        }
        

        $this->setTestReturnData('boardInfo', $board);
        $this->sendResult(200);
    }

    // 게시글 삭제 (Soft Delete)
    public function destroy($id)
    {
        $board = Board::find($id);
        if (!$board) {
            $this->setTestReturnData('board', $board);
            return $this->sendErrorResult('게시글을 찾을 수 없습니다.', 404);
        }

        $board->delete(); // Soft Delete 적용
        $this->sendResult(200, '게시글이 삭제되었습니다.');
    }

}
