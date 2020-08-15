<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>전북 축제 On!</title>
    <script src="/resources/jquery-3.5.0.min.js"></script>
    <link rel="stylesheet" href="/resources/bootstrap-4.4.1-dist/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <script src="/resources/bootstrap-4.4.1-dist/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/resources/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/resources/css/style.css">
    <script src="/resources/js/common.js"></script>
</head>
<body>
    <!-- 로그인 -->
    <form action="/login" method="post" id="login-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body pt-4 px-3">
                    <div class="title text-center mb-4">
                        <h1>SIGN <strong>IN</strong></h1>
                        <p>로그인</p>
                    </div>
                    <div class="form-group">
                        <label for="login_id">아이디</label>
                        <input type="text" id="login_id" name="user_id" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="login_pw">비밀번호</label>
                        <input type="password" id="login_pw" name="password" class="form-control">
                    </div>
                    <div class="form-group d-between">
                        <div class="d-center">
                            <input type="checkbox" id="remember">
                            <label for="remember" class="ml-2 mb-0 text-muted fx-n2">Remember me</label>
                        </div>
                        <a href="#" class="text-muted fx-n2">Forgot Password</a>
                    </div>
                    <div class="form-group text-right mt-5">
                        <button class="btn-filled">로그인</button>
                        <button type="button" class="btn-bordered">회원가입</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- /로그인 -->

    <!-- 찾아오시는 길 -->
    <div id="road-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body px-4 py-5 text-center fx-3 font-weight-bold keep-all"></div>
            </div>
        </div>
    </div>
    <!-- /찾아오시는 길 -->

    <!-- 헤더 영역 -->
    <input type="checkbox" id="open-search" hidden>
    <input type="checkbox" id="open-aside" hidden>
    <header <?= $viewName !== "home" ? 'class="header--subpage"' : '' ?>>
        <aside class="aside d-lg-none">
            <div class="utility utility--mobile">
                <select>
                    <option value="한국어">한국어</option>
                    <option value="English">English</option>
                    <option value="中文(简体">简体</option>
                </select>
                <a href="#" class="ml-3">전라북도청</a>
                <?php if(user()):?>
                    <a class="ml-3">환영합니다</a>
                    <a href="/logout" class="ml-3">로그아웃</a>
                <?php else:?>
                    <a href="#" data-toggle="modal" data-target="#login-modal" class="ml-3">로그인</a>
                    <a href="#" class="ml-3">회원가입</a>
                <?php endif;?>
            </div>
            <div class="nav nav--mobile">
                <a class="nav__link nav__link--mobile" href="/">HOME</a>
                <a class="nav__link nav__link--mobile" href="/festival-main">전북 대표 축제</a>
                <a class="nav__link nav__link--mobile" href="/festival-list">축제 정보</a>
                <a class="nav__link nav__link--mobile" href="/schedules">축제 일정</a>
                <a class="nav__link nav__link--mobile" href="/exchange-guide">환율안내</a>
                <div class="nav__link nav__link--mobile" href="#">
                    종합지원센터
                    <div class="nav-sub nav-sub--mobile">
                        <a href="/notice">공지사항</a>
                        <a href="#">센터 소개</a>
                        <a href="#">관광정보 문의</a>
                        <a href="#">데이터 공개</a>
                        <a href="#" data-target="#road-modal">찾아오시는 길</a>
                    </div>
                </div>
            </div>
        </aside>
        <div class="header-top d-none d-lg-flex">
            <div class="container h-100 d-between">
                <div class="search">
                    <div class="search__icon"><i class="fa fa-search"></i></div>
                    <input type="text" class="search__input" placeholder="Search">
                </div>
                <div class="utility">
                    <select>
                        <option value="한국어">한국어</option>
                        <option value="English">English</option>
                        <option value="中文(简体">简体</option>
                    </select>
                    <a href="#" class="ml-3">전라북도청</a>
                    <?php if(user()):?>
                        <a class="ml-3">환영합니다</a>
                        <a href="/logout" class="ml-3">로그아웃</a>
                    <?php else:?>
                        <a href="#" data-toggle="modal" data-target="#login-modal" class="ml-3">로그인</a>
                        <a href="#" class="ml-3">회원가입</a>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container h-100 d-between">
                <label for="open-search" class="header-icon d-lg-none">
                    <i class="fa fa-search"></i>
                </label>
                <a href="/" class="logo">
                    <img src="/resources/images/logo.svg" alt="전북축제 On!" title="전북축제 On!" height="40">
                </a>
                <label for="open-aside" class="header-icon d-lg-none">
                    <i class="fa fa-bars"></i>
                </label>
                <div class="nav d-none d-lg-flex">
                    <a class="nav__link" href="/">HOME</a>
                    <a class="nav__link" href="/festival-main">전북 대표 축제</a>
                    <a class="nav__link" href="/festival-list">축제 정보</a>
                    <a class="nav__link" href="/schedules">축제 일정</a>
                    <a class="nav__link" href="/exchange-guide">환율안내</a>
                    <div class="nav__link">
                        종합지원센터
                        <div class="nav-sub">
                            <a href="/notice">공지사항</a>
                            <a href="#">센터 소개</a>
                            <a href="#">관광정보 문의</a>
                            <a href="#">데이터 공개</a>
                            <a href="#" data-target="#road-modal">찾아오시는 길</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>