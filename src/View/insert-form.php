    <div class="header-sub">
        <div class="container">
            <div class="text-white">
                <a href="/festival-list">축제 정보</a>
                <i class="fa fa-angle-right mx-2"></i>
                <a href="/festivals/form">축제 등록</a>
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

<form action="/insert/festivals" method="post" enctype="multipart/form-data" class="container padding">
    <hr>
    <div class="fx-5 font-weight-bold">축제 등록</div>
    <div class="mt-4">
        <div class="form-group">
            <label>축제명</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label>축제 기간</label>
            <input type="text" name="period" class="form-control" placeholder="ex) 2020-01-01 ~ 2020-01-31">
        </div>
        <div class="form-group">
            <label>축제 지역</label>
            <input type="text" name="area" class="form-control">
        </div>
        <div class="form-group">
            <label>축제 장소</label>
            <input type="text" name="location" class="form-control">
        </div>
        <div class="form-group">
            <label>축제 사진</label>
            <div class="custom-file">
                <label for="upload-image" class="custom-file-label">파일을 선택하세요</label>
                <input type="file" name="images[]" id="upload-image" class="custom-file-input" multiple>
            </div>
        </div>
    </div>
    <div class="text-right border-top pt-4 mt-4">
        <button class="btn-filled">저장</button>
    </div>
</form>