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

- Seeder : 더미 데이터 생성
```bash
php artisan make:seeder BoardSeeder
php artisan make:seeder CommentSeeder

=== database/seeders/DatabaseSeeder.php 에 $this->call() 메서드에 배열로 시드 등록

php artisan db:seed         // 전체 시드 샐행
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


# BBS (게시판) API 문서

Laravel 기반의 게시판 시스템 API 문서입니다.

## 목차
- [기본 정보](#기본-정보)
- [응답 구조](#응답-구조)
- [게시글 API](#게시글-api)
- [댓글 API](#댓글-api)
- [에러 코드](#에러-코드)

## 기본 정보

### Base URL
```
https://your-domain.com/api
```

### 인증
현재 버전에서는 인증이 구현되어 있지 않습니다.

### Content-Type
```
Content-Type: application/json
```

---

## 응답 구조

모든 API 응답은 다음과 같은 공통 구조를 가집니다.

| 필드명      | 타입      | 설명                          |
|-----------|---------|-----------------------------|
| server    | object  | 서버 정보 객체                  |
| server.version | string | API 버전                    |
| server.app_env | string | 환경 정보 ( development, productiond 등)    |
| success   | boolean | 요청 성공 여부 (true/false)   |
| message   | string  | 결과 메시지                   |
| data      | object  | 요청 결과 데이터               |
### 성공 응답
```json
{
  "server": {
    "version": "1.0.0",
    "app_env": "production"
  },
  "success": true,
  "message": "ok",
  "data": {
    // 실제 응답 데이터
  },
  "testData": {
    // 개발 환경에서만 표시 (app.env = development)
  }
}
```

### 에러 응답
```json
{
  "server": {
    "version": "1.0.0", 
    "app_env": "production"
  },
  "success": false,
  "message": "에러 메시지",
  "data": {},
  "testData": {
    // 개발 환경에서만 표시 (app.env = development)
  }
}
```

---

## 게시글 API

### 1. 전체 게시글 조회
게시판의 모든 게시글을 조회합니다.

```http
GET /boards
```

**Response (200 OK)**
```json
{
  "server": {
    "version": "1.0.0",
    "app_env": "production"
  },
  "success": true,
  "message": "ok",
  "data": {
    "boardList": [
      {
        "id": 1,
        "title": "게시글 제목",
        "content": "게시글 내용",
        "create_user": "작성자",
        "created_at": "2024-01-01T00:00:00.000000Z",
        "deleted_at": null
      }
    ]
  }
}
```

### 2. 단일 게시글 조회
특정 게시글의 상세 정보를 조회합니다.

```http
GET /boards/{id}
```

**Parameters**
- `id` (integer, required): 게시글 ID

**Response (201 Created)**
```json
{
  "server": {
    "version": "1.0.0",
    "app_env": "production"
  },
  "success": true,
  "message": "ok",
  "data": {
    "boardDetail": {
      "id": 1,
      "title": "게시글 제목",
      "content": "게시글 내용",
      "create_user": "작성자",
      "created_at": "2024-01-01T00:00:00.000000Z",
      "deleted_at": null
    }
  }
}
```

**Error Response (404 Not Found)**
```json
{
  "server": {
    "version": "1.0.0",
    "app_env": "production"
  },
  "success": false,
  "msg": "게시글을 찾을 수 없습니다.",
  "data": {}
}
```

### 3. 게시글 생성
새로운 게시글을 생성합니다.

```http
POST /boards
```

**Request Body**
```json
{
  "title": "게시글 제목",
  "content": "게시글 내용",
  "createUser": "작성자명"
}
```

**Response (201 Created)**
```json
{
  "server": {
    "version": "1.0.0",
    "app_env": "production"
  },
  "success": true,
  "message": "ok",
  "data": {
    "boardId": 1
  }
}
```

**Validation Error (422 Unprocessable Entity)**
```json
{
  "server": {
    "version": "1.0.0",
    "app_env": "production"
  },
  "success": false,
  "msg": "title 필드는 필수입니다.",
  "data": {}
}
```

### 4. 게시글 수정
기존 게시글을 수정합니다.

```http
PUT /boards/{id}
```

**Parameters**
- `id` (integer, required): 게시글 ID

**Request Body**
```json
{
  "title": "수정된 제목",
  "content": "수정된 내용", 
  "createUser": "작성자명"
}
```

**Response (200 OK)**
```json
{
  "server": {
    "version": "1.0.0",
    "app_env": "production"
  },
  "success": true,
  "message": "ok",
  "data": {
    "boardId": 1
  }
}
```

**No Changes Error (400 Bad Request)**
```json
{
  "server": {
    "version": "1.0.0",
    "app_env": "production"
  },
  "success": false,
  "msg": "업데이트할 값이 없습니다",
  "data": {}
}
```

### 5. 게시글 삭제
게시글을 삭제합니다 (Soft Delete).

```http
DELETE /boards/{id}
```

**Parameters**
- `id` (integer, required): 게시글 ID

**Response (200 OK)**
```json
{
  "server": {
    "version": "1.0.0",
    "app_env": "production"
  },
  "success": true,
  "message": "게시글이 삭제되었습니다.",
  "data": {}
}
```

---

## 댓글 API

### 1. 댓글 목록 조회
특정 게시글의 모든 댓글을 조회합니다.

```http
GET /boards/{boardId}/comments
```

**Parameters**
- `boardId` (integer, required): 게시글 ID

**Response (200 OK)**
```json
{
  "server": {
    "version": "1.0.0",
    "app_env": "production"
  },
  "success": true,
  "message": "ok",
  "data": {
    "comments": [
      {
        "id": 1,
        "board_id": 1,
        "content": "댓글 내용",
        "create_user": "댓글 작성자",
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z",
        "deleted_at": null
      }
    ]
  }
}
```

**Error Response (404 Not Found)**
```json
{
  "server": {
    "version": "1.0.0",
    "app_env": "production"
  },
  "success": false,
  "msg": "게시글을 찾을 수 없습니다.",
  "data": {}
}
```

### 2. 댓글 생성
게시글에 새로운 댓글을 추가합니다.

```http
POST /boards/{boardId}/comments
```

**Parameters**
- `boardId` (integer, required): 게시글 ID

**Request Body**
```json
{
  "content": "댓글 내용",
  "create_user": "댓글 작성자"
}
```

**Response (201 Created)**
```json
{
  "server": {
    "version": "1.0.0",
    "app_env": "production"
  },
  "success": true,
  "message": "등록이 완료되었습니다.",
  "data": {
    "commentId": 1,
    "boardId": 1
  }
}
```

**Server Error (500 Internal Server Error)**
```json
{
  "server": {
    "version": "1.0.0",
    "app_env": "production"
  },
  "success": false,
  "msg": "코맨트 등록에 실패하였습니다.",
  "data": {},
  "testData": {
    "exception": "Database connection failed"
  }
}
```

### 3. 댓글 수정
기존 댓글을 수정합니다.

```http
PUT /boards/{boardId}/comments/{id}
```

**Parameters**
- `boardId` (integer, required): 게시글 ID
- `id` (integer, required): 댓글 ID

**Request Body**
```json
{
  "content": "수정된 댓글 내용"
}
```

**Response (200 OK)**
```json
{
  "server": {
    "version": "1.0.0",
    "app_env": "production"
  },
  "success": true,
  "message": "수정되었습니다.",
  "data": {
    "commentId": 1,
    "boardId": 1
  },
  "testData": {
    "comment": {
      "id": 1,
      "board_id": 1,
      "content": "수정된 댓글 내용",
      "create_user": "댓글 작성자",
      "created_at": "2024-01-01T00:00:00.000000Z",
      "updated_at": "2024-01-01T12:00:00.000000Z"
    }
  }
}
```

### 4. 댓글 삭제
댓글을 삭제합니다.

```http
DELETE /boards/{boardId}/comments/{id}
```

**Parameters**
- `boardId` (integer, required): 게시글 ID
- `id` (integer, required): 댓글 ID

**Response (200 OK)**
```json
{
  "server": {
    "version": "1.0.0",
    "app_env": "production"
  },
  "success": true,
  "message": "삭제되었습니다.",
  "data": {}
}
```

**Error Response (404 Not Found)**
```json
{
  "server": {
    "version": "1.0.0",
    "app_env": "production"
  },
  "success": false,
  "msg": "댓글을 찾을 수 없습니다.",
  "data": {}
}
```

---

## 에러 코드

| HTTP Status | 설명 |
|-------------|------|
| 200 | OK - 성공 |
| 201 | Created - 생성 성공 |
| 400 | Bad Request - 잘못된 요청 |
| 404 | Not Found - 리소스를 찾을 수 없음 |
| 422 | Unprocessable Entity - 유효성 검사 실패 |
| 500 | Internal Server Error - 서버 내부 에러 |

### 일반적인 에러 메시지

**게시글 관련**
- `게시글을 찾을 수 없습니다.` (404)
- `게시글 등록에 실패하였습니다.` (500)
- `게시글 수정에 실패하였습니다.` (500)
- `업데이트할 값이 없습니다` (400)

**댓글 관련**
- `댓글을 찾을 수 없습니다.` (404)
- `코맨트 등록에 실패하였습니다.` (500)
- `코맨트 삭제에 실패하였습니다.` (500)

**유효성 검사**
- 각 필드별 유효성 검사 메시지 (422)

---

## 개발/테스트 환경

### testData 필드
개발 환경(`app.env = development`)에서만 `testData` 필드가 응답에 포함됩니다. 이 필드는 디버깅과 테스트 목적으로 사용됩니다.

**개발 환경 응답 예시:**
```json
{
  "server": {
    "version": "1.0.0",
    "app_env": "development"
  },
  "success": true,
  "message": "ok",
  "data": {
    "boardId": 1
  },
  "testData": {
    "boardInfo": {...},
    "exception": "Error details..."
  }
}
```

**운영 환경 응답 예시:**
```json
{
  "server": {
    "version": "1.0.0",
    "app_env": "production"
  },
  "success": true,
  "message": "ok", 
  "data": {
    "boardId": 1
  }
}
```

---

## 사용 예시

### 게시글 생성 후 댓글 추가

```bash
# 1. 게시글 생성
curl -X POST https://your-domain.com/api/boards \
  -H "Content-Type: application/json" \
  -d '{
    "title": "새 게시글",
    "content": "게시글 내용입니다",
    "createUser": "홍길동"
  }'

# Response:
# {
#   "server": {"version": "1.0.0", "app_env": "production"},
#   "success": true,
#   "message": "ok",
#   "data": {"boardId": 1}
# }

# 2. 댓글 추가
curl -X POST https://your-domain.com/api/boards/1/comments \
  -H "Content-Type: application/json" \
  -d '{
    "content": "첫 번째 댓글입니다",
    "create_user": "김철수"
  }'

# Response:
# {
#   "server": {"version": "1.0.0", "app_env": "production"},
#   "success": true,
#   "message": "등록이 완료되었습니다.",
#   "data": {"commentId": 1, "boardId": 1}
# }
```

---

## 개발 참고사항

- **응답 구조**: 모든 API는 공통된 응답 구조를 따릅니다
- **서버 정보**: 각 응답에는 서버 버전과 환경 정보가 포함됩니다
- **테스트 데이터**: 개발 환경에서만 `testData` 필드가 추가됩니다
- **Soft Delete**: 게시글 삭제는 Soft Delete로 구현됩니다
- **Nested Resource**: 댓글은 게시글의 하위 리소스입니다
- **날짜 형식**: 모든 날짜는 ISO 8601 형식으로 반환됩니다
- **에러 필드**: 성공 시 `message`, 실패 시 `msg` 필드를 사용합니다