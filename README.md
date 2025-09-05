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
```bash
- MySQL 사용
- .env 파일에서 DB 연결 설정
```

- Controller
```bash
php artisan make:controller BbsController
php artisan make:controller CommentController
```

- DB migration
```bash
php artisan make:migration create_boards_table  // 게시판 테이블
php artisan make:migration create_comment_table // 게시판의 코멘트 테이블
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
```


