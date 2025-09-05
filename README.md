# Laravel FastView 게시판 프로젝트

이 프로젝트는 Laravel 10 기반으로 만든 간단한 게시판 CRUD API 프로젝트입니다.  
`created_at`만 사용하며, `updated_at`은 사용하지 않습니다.

---

## 환경 설정

### PHP 및 Laravel

- PHP 8.1 이상
- Laravel 10
- Composer 설치 필요


## 세팅
- Larvel 10 버전 설치

```bash
composer create-project laravel/laravel fastview "10.*"
```


- 데이터베이스
    - MySQL 사용
    - .env 파일에서 사용하고 있는 DB 정보로 변경( {} 는 각자에 맞게 변경이 필요 )
        - DB_CONNECTION=mysql
        - DB_HOST={db_host}
        - DB_PORT=3306
        - DB_DATABASE={database_name}
        - DB_USERNAME={db_user_id}
        - DB_PASSWORD={db_user_pw}
    - env 파일 내용 변경 - 개발환경 세팅
        - APP_ENV=development

- Controller
```bash
php artisan make:controller BbsController
php artisan make:controller CommentController
```

- Model
```bash
php artisan make:model Board
php artisan make:model Comment
```

- Databases
    - MySQL 사용
    - .env 파일에서 사용하고 있는 DB 정보로 변경
    - DB migration
        ```bash
        php artisan make:migration create_boards_table  // 게시판 테이블
        php artisan make:migration create_comment_table // 게시판의 코멘트 테이블
        php artisan migrate     // DB 생성

        // 테이블이 이미 생성 된 후 컬럼을 추가 할 경우 새로운 migration 파일 만들어서 마이그레이션 실행
        php artisan make:migration add_deleted_at_to_boards_table --table=boards
        php artisan make:migration add_deleted_at_to_comments_table --table=comments
        php artisan migrate     // DB 생성
        ```
---
## 파일 Tree
```bash
📦app
 ┣ 📂Exceptions
 ┃ ┗ 📜Handler.php
 ┣ 📂Http
 ┃ ┣ 📂Controllers
 ┃ ┃ ┣ 📜BbsController.php
 ┃ ┃ ┣ 📜CommentController.php
 ┃ ┃ ┗ 📜Controller.php
 ┣ 📂Models
 ┃ ┣ 📜Board.php
 ┃ ┣ 📜Comment.php
 ┣ 📂Validators
 ┃ ┣ 📜BoardValidator.php
 ┃ 📜.env
```
---

## SERVER 실행 및 종료
- 실행 : php artisan serve      // 명령어 실행.. (로컬 개발이기 때문에... 실서버에서는 백그라운드 실행)
- 종료 : Ctrl + C

## Api Routes
- File Path : routes/api.php


# Laravel Board API

## 공통 Response 구조

모든 API는 공통적으로 아래와 같은 Response 구조를 가집니다.

```json
{
  "server": {
    "version": "1.0.0",   // API 버전
    "app_env": "development"  // 개발 환경 (development / production)
  },
  "success": true,       // 성공 여부
  "message": "",       // 메시지
  "data": {},             // 실제 데이터
  "teatData" : {}       // app_env 가 development 일 때 만 노출 (데이터 확인 용도)
}
```

---

## API 목록

| 기능         | Method | URL                     | Request                                                     | Response                                                                      |
| ---------- | ------ | ----------------------- | ----------------------------------------------------------- | ----------------------------------------------------------------------------- |
| 게시판 리스트    | GET    | /api/boards             | 없음                                                          | 아래 예시 참고               |
| 게시판 글쓰기    | POST   | /api/boards             | `{ "title": string, "content": string, "createUser": string }` | 없음 |
| 게시판 글수정    | PUT    | /api/boards/{board\_id} | `{ "title": string, "content": string }`                      | 없음 |
| 게시판 글삭제    | DELETE | /api/boards/{board\_id} | 없음                                                          | 없음                     |
| 게시판 글 상세정보 | GET    | /api/boards/{board\_id} | 없음                                                          | 없음          |

---

## 예시 Response

### 게시판 리스트 (GET /api/boards)

```json
{
  "server": {
    "version": "1.0.0",
    "app_env": "development"
  },
  "success": true,
  "message": "",
  "data": [
    {
      "id": 1,
      "title": "첫 번째 글",
      "content": "내용입니다.",
      "create_user": "tester",
      "created_at": "2025-09-06T12:00:00",
      "updated_at": "2025-09-06T12:00:00"
    }
  ]
}
```

### 게시판 리스트 (GET /api/boards)

```json
{
  "server": {
    "version": "1.0.0",
    "app_env": "development"
  },
  "success": true,
  "message": "",
  "data": {
    "boardDetail": {
      "id": 1,
      "title": "첫 번째 글",
      "content": "내용입니다.",
      "create_user": "tester",
      "created_at": "2025-09-06T12:00:00",
      "updated_at": "2025-09-06T12:00:00"
    }
  }
}
```



