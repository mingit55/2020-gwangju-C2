    <div class="header-sub">
        <div class="container">
            <div class="text-white">
                <a href="/festival-list">축제 정보</a>
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
    <div class="d-between">
        <div class="title">
            <h1>JEONBOK <strong>ON!</strong></h1>
            <p>전북 축제</p>
        </div>
        <?php if(user()):?>
            <a href="/festivals/form" class="btn-filled">축제 등록</a>
        <?php endif;?>
    </div>
    <div class="t-head border-top mt-5">
        <div class="cell-10">번호</div>
        <div class="cell-40">축제명(사진)</div>
        <div class="cell-20">다운로드</div>
        <div class="cell-20">기간</div>
        <div class="cell-10">장소</div>
    </div>
    <?php foreach($festivals->data as $item):?>
        <div class="t-row"> 
            <?php if(user()):?>
                <a href="/festivals/form/<?=$item->id?>" class="cell-10"><?= $item->no ?></a>
            <?php else:?>
                <div class="cell-10"><?= $item->no ?></div>
            <?php endif;?>
            <a href="/festivals/<?=$item->id?>" class="cell-40 text-left px-3 text-ellipsis">
                <?= $item->name ?>
                <span class="badge badge-danger">
                    <?= $item->cnt ?>
                </span>
            </a>
            <div class="cell-20">
                <a href="/festivals/tar/<?= $item->id ?>" class="btn-filled">tar</a>
                <a href="/festivals/zip/<?= $item->id ?>" class="btn-bordered">zip</a>
            </div>
            <div class="cell-20"><?= $item->period ?></div>
            <div class="cell-10"><?= $item->area ?></div>
        </div>
    <?php endforeach;?>
    <div class="pagination">
        <a href="/festival-list?page=<?=$festival->prev_page?>" class="pagination__blink" <?= $festivals->prev ? '' : 'disabled' ?>>
            <i class="fa fa-angle-left"></i>
        </a>
        <?php for($i = $festivals->start; $i <= $festivals->end; $i++):?>
            <a href="/festival-list?page=<?=$i?>" class="pagination__link <?=$i == $festivals->page ? 'active': ''?>"><?=$i?></a>
        <?php endfor;?>
        <a href="/festival-list?page=<?=$festival->next_page?>" class="pagination__blink" <?= $festivals->next ? '' : 'disabled' ?>>
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div>
<!-- /축제 정보 영역 -->