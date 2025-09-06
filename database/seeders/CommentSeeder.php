<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Board;
use App\Models\Comment;
use Carbon\Carbon;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 게시글이 있어야 코멘트를 남길 수 있기 때문
        $boards = Board::all();
        
        $authors = ['김철수', '이영희', '박민수', '최지연', '정대한', null];
        
        $comments = [
            '좋은 정보 감사합니다!',
            '도움이 되었어요.',
            '질문이 있는데요.',
            '잘 정리되었네요.',
            '참고하겠습니다.',
            '감사합니다.',
            '좋아요!',
            '유용한 내용이에요.'
        ];

        foreach ($boards as $board) {
            $commentCount = rand(0, 5); // 게시글당 0~5개 댓글
            
            for ($i = 0; $i < $commentCount; $i++) {
                Comment::create([
                    'board_id' => $board->id,
                    'author' => $authors[array_rand($authors)],
                    'content' => $comments[array_rand($comments)],
                    'created_at' => Carbon::now()->subDays(rand(0, 10))
                ]);
            }
        }
    }
}
