    <div class="header-sub">
        <div class="container">
            <div class="text-white">
                <a href="/festival-list">축제 정보</a>
                <i class="fa fa-angle-right mx-2"></i>
                <a href="/festivals/<?=$festival->id?>">상세 정보</a>
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


<!-- 상세 정보 영역 -->
<div class="container padding">
    <div class="title">
        <h1>DETAIL INFO</h1>
        <p>상세 정보</p>
    </div>
    <hr>
    <div class="row mt-5">
        <div class="col-lg-5">
            <?php if(count($files) > 0):?>
                <img class="fit-cover" height="400" src="<?=$festival->imagePath?>/<?=$files[0]->local_name?>" alt="축제 이미지">
            <?php else:?>
                <img src="/resources/images/no-image.png" alt="No image">
            <?php endif;?>
        </div>
        <div class="col-lg-6 offset-lg-1 py-4">
            <div class="fx-5 mb-4"><?= $festival->name ?></div>
            <div class="text-muted fx-n2"><?= $festival->content ? $festival->content: "축제 설명이 존재하지 않습니다." ?></div>
            <div class="mt-4">
                <div class="mb-2">
                    <span class="mr-3 text-muted fx-n2">지역</span>
                    <span class="fx-n1"><?=$festival->area?></span>
                </div>
                <div class="mb-2">
                    <span class="mr-3 text-muted fx-n2">장소</span>
                    <span class="fx-n1"><?=$festival->location?></span>
                </div>
                <div class="mb-2">
                    <span class="mr-3 text-muted fx-n2">기간</span>
                    <span class="fx-n1"><?=$festival->period?></span>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mt-5">
            <div class="fx-3 border-bottom pb-2 mb-4 text-red font-weight-bold">축제 사진</div>
            <div class="row">
                <?php foreach($files as $file):?>
                <div class="col-lg-3">
                    <img class="fit-cover" height="350" src="<?=$festival->imagePath?>/<?=$file->local_name?>" alt="축제 이미지">
                </div>
                <?php endforeach;?>
                <?php if(count($files) == 0):?>
                    <div class="col-lg-12 py-5 text-center text-muted fx-3">
                        업로드된 이미지가 없습니다.
                    </div>
                <?php endif;?>
            </div>
        </div>
        <div class="col-lg-12 mt-5">
            <div class="d-between border-bottom pb-2 mb-4">
                <div class="fx-3 text-red font-weight-bold">축제 후기</div>
                <button class="btn-filled" data-toggle="modal" data-target="#review-modal">후기 등록</button>
            </div>
            <?php foreach($reviews as $review):?>
                <div class="py-4 border-bottom">
                    <div class="d-between">
                        <div>
                            <span class="fx-3"><?=$review->user_name?></span>
                            <span class="ml-3 text-red"><i class="fa fa-star"></i> <?=$review->score?></span>
                        </div>
                        <?php if(user()):?>
                            <a href="/delete/reviews/<?=$review->id?>" class="btn-bordered">삭제</a>
                        <?php endif;?>
                    </div>
                    <div class="mt-3 text-muted fx-n2"><?= nl2br(htmlentities($review->content)) ?></div>
                </div>
            <?php endforeach;?>
            <?php if(count($reviews) === 0):?>
                <p class="py-5 fx-n2 text-muted text-center">
                    작성된 후기가 없습니다.
                </p>
            <?php endif;?>
        </div>
    </div>
</div>
<!-- /상세 정보 영역 -->

<!-- 후기 등록 -->
<form action="/festivals/<?=$festival->id?>/reviews" method="post" id="review-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-between">
                <h4 class="text-red">후기 등록</h4>
                <button class="fx-3" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="user_name">이름</label>
                    <input type="text" id="user_name" name="user_name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="score">별점</label>
                    <select name="score" id="score" class="form-control">
                        <option value="1">1점</option>
                        <option value="2">2점</option>
                        <option value="3">3점</option>
                        <option value="4">4점</option>
                        <option value="5">5점</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="content">후기 내용</label>
                    <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer text-right">
                <button class="btn-filled">후기 등록</button>
            </div>
        </div>
    </div>
</form>
<!-- /후기 등록 -->