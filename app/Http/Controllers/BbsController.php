<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;

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

}
