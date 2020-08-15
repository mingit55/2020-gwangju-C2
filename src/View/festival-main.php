    <div class="header-sub">
        <div class="container">
            <div class="text-white">
                <a href="#">전북 대표 축제</a>
            </div>
        </div>
    </div>
    <div class="search search--mobile">
        <span class="search__icon search__icon--mobile"><i class="fa fa-search"></i></span>
        <input type="text" class="search__input search__input--mobile" placeholder="Search">
        <label for="open-search" class="search__icon search__icon--mobile">
            <i class="fa fa-times"></i>
        </label>
    </div>
</header>
<!-- /헤더 영역 -->

<!-- 축제 정보 영역 -->
<div class="container padding">
    <div class="d-between align-items-end border-bottom pb-3 mb-5">
        <div class="title">
            <h1>FESTIVAL <strong>ON!</strong></h1>
            <p>전북 대표 축제</p>
        </div>
        <div class="f-tab">
            <a href="?view-type=1" data-id="1" class="f-tab__item active"><i class="fa fa-list"></i> 목록형</a>
            <a href="?view-type=2" data-id="2" class="f-tab__item ml-3"><i class="fa fa-table"></i> 앨범형</a>
        </div>
    </div>
    <div class="f-tab__content"></div>
    <div class="pagination mt-5">
        
    </div>
</div>
<script src="/resources/js/festival-main.js"></script>
<!-- /축제 정보 영역 -->

<!-- 축제 정보 모달 -->
<div id="view-modal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body px-4 py-4">
                <div class="row">
                    <div class="col-lg-4">
                        <img class="f-image fit-cover" src="/resources/xml/festivalImages/004_10005/10005_1.jpg" alt="No image">
                    </div>
                    <div class="col-lg-8">
                        <div class="fx-n1 text-muted">축제 정보</div>
                        <div class="fx-3 font-weight-bold name">춘향제</div>
                        <div class="mt-4">
                            <div class="mt-1">
                                <span class="text-muted mr-3 fx-n2">축제지역</span>
                                <span class="fx-n1 area">남원</span>
                            </div>
                            <div class="mt-1">
                                <span class="text-muted mr-3 fx-n2">축제장소</span>
                                <span class="fx-n1 location">전라북도 남원시 운봉읍 비래봉길</span>
                            </div>
                            <div class="mt-1">
                                <span class="text-muted mr-3 fx-n2">축제기간</span>
                                <span class="fx-n1 period">2020-08-01 ~ 08-05</span>
                            </div>
                            <p class="mt-3 fx-n2 text-muted content">설명</p>
                        </div>
                    </div>
                    <hr class="my-4 mx-auto">
                    <div class="col-lg-12">
                        <div class="fx-2 font-weight-bold mb-3">축제 사진</div>
                        <div class="f-slide">
                            <div class="f-slide__inner"></div>
                        </div>
                        <div class="f-control mt-4">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /축제 정보 모달 -->