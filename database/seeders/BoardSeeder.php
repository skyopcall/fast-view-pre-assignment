<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Board;
use Carbon\Carbon;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $boards = [
            [
                'title' => 'TEST1',
                'content' => 'Content TESt 01',
                'create_user' => '관리자',
                'created_at' => Carbon::now()->subDays(10),
            ],
            [
                'title' => '라라벨 프로젝트',
                'content' => '라라벨로 만든 게시판 프로젝트입니다.',
                'create_user' => '홍길동',
                'created_at' => Carbon::now()->subDays(8),
            ],
            [
                'title' => '디비에 연결도 쉽게 할 수 있어요',
                'content' => 'route로 url 을 관리하며 미등뤠어에서 인증, 권한 설정을 기본으로 제공해요',
                'create_user' => '김디비',
                'created_at' => Carbon::now()->subDays(7),
            ],
            [
                'title' => '새로운 프로젝트를 시작했어요!',
                'content' => '라라벨은 다양한 웹 기반 모듈이 있어요.',
                'create_user' => '오영이',
                'created_at' => Carbon::now()->subDays(5),
            ]
        ];

        // 일반 게시글 생성
        foreach ($boards as $boardData) {
            Board::create($boardData);
        }
    }
}
