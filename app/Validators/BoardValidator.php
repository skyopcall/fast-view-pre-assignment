<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;

class BoardValidator
{
    public static function validate(array $data)
    {
        return Validator::make($data, [
            'title'      => 'required|string|max:255',
            'content'    => 'required|string',
            'createUser' => 'required|string',
        ], [
            'title.required'      => '제목은 필수 항목입니다.',
            'title.max'           => '제목은 최대 255자까지 입력 가능합니다.',
            'content.required'    => '내용은 필수 항목입니다.',
            'createUser.required' => '작성자는 필수 항목입니다.',
        ]);
    }

    public static function commentValidate(array $data)
    {
        return Validator::make($data, [
            'author'      => 'required|string|max:255',
            'content' => 'required|string',
        ], [
            'author.required'      => '작성자는 필수 항목입니다.',
            'content.required' => '내용은 필수 항목입니다.',
        ]);
    }
}
