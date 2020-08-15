<div class="header-sub">
        <div class="container">
            <div class="text-white">
                <a href="/festival-list">축제 정보</a>
                <i class="fa fa-angle-right mx-2"></i>
                <a href="/festivals/form/<?=$festival->id?>">정보 수정</a>
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

<form action="/update/festivals/<?=$festival->id?>" method="post" enctype="multipart/form-data" class="container padding">
    <hr>
    <div class="fx-5 font-weight-bold">정보 수정</div>
    <div class="mt-4">
        <div class="form-group">
            <label>축제명</label>
            <input type="text" name="name" class="form-control" value="<?= $festival->name ?>">
        </div>
        <div class="form-group">
            <label>축제 기간</label>
            <input type="text" name="period" class="form-control" placeholder="ex) 2020-01-01 ~ 2020-01-31" value="<?= $festival->start_date ?> ~ <?= $festival->end_date ?>">
        </div>
        <div class="form-group">
            <label>축제 지역</label>
            <input type="text" name="area" class="form-control" value="<?= $festival->area ?>">
        </div>
        <div class="form-group">
            <label>축제 장소</label>
            <input type="text" name="location" class="form-control" value="<?= $festival->location ?>">
        </div>
        <div class="form-group">
            <label>축제 사진</label>
            <div class="fx-n3 text-muted mb-2">※ 남길 파일을 선택하세요</div>
            <div class="bg-light border p-2 mb-3">
                <?php foreach($files as $file):?>
                    <span class="p-3">
                        <input type="checkbox" name="left_images[]" value="<?=$file->id?>" class="mr-1" checked>
                        <?= $file->origin_name ?>
                    </span>
                <?php endforeach;?>
                <?php if(count($files) === 0):?>
                    <input type="hidden" name="left_images[]" value="">
                    <small class="text-muted">기존에 추가한 파일이 없습니다.</small>
                <?php endif;?>
            </div>
            <div class="fx-n3 text-muted mb-2">※ 추가할 파일을 선택하세요</div>
            <div class="custom-file">
                <label for="upload-image" class="custom-file-label">파일을 선택하세요</label>
                <input type="file" name="add_images[]" id="upload-image" class="custom-file-input" multiple>
            </div>
        </div>
    </div>
    <div class="text-right border-top pt-4 mt-4">
        <button class="btn-filled">저장</button>
        <a href="/delete/festivals/<?=$festival->id?>" class="btn-bordered">삭제</a>
    </div>
</form>