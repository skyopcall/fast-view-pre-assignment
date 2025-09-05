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
  
        $board = Board::create($request->all());
        if(!$board){
            return $this->sendErrorResult('게시글 등록에 실패하였습니다.', 500);
        }

        $this->setTestReturnData('boardInfo', $board);
        $this->sendResult(201);
    }

}
