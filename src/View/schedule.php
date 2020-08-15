    <div class="header-sub">
        <div class="container">
            <div class="text-white">
                <a href="/festival-list">축제 일정</a>
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

<div class="container padding">
    <div class="calender">
        <div class="calender__header d-between">
            <a href="/schedules?year=<?=date('Y')?>&month=<?=date('m')?>" class="btn-bordered">이번달</a>
            <div class="calender__title">
                <a href="/schedules?year=<?=date('Y', $time__prev_month)?>&month=<?=date('m', $time__prev_month)?>"><i class="fa fa-angle-left"></i></a>
                <h1><?=date('Y년 m월', $time__first_day)?></h1>
                <a href="/schedules?year=<?=date('Y', $time__next_month)?>&month=<?=date('m', $time__next_month)?>"><i class="fa fa-angle-right"></i></a>
            </div>
            <a href="/festival-list" class="btn-bordered">축제관리</a>
        </div>
        <div class="calender__body">
            <div class="calender__day">일</div>
            <div class="calender__day">월</div>
            <div class="calender__day">화</div>
            <div class="calender__day">수</div>
            <div class="calender__day">목</div>
            <div class="calender__day">금</div>
            <div class="calender__day">토</div>
            <?php for($i = 0; $i < date("w", $time__first_day); $i++):?>
                <div class="calender__item calender__item--empty"></div>
            <?php endfor;?>
            <?php 
                global $day;                                        // 글로벌 변수로 day를 지정한다. (callback에서 사용할 수 있도록)
                $prev_events = [];                                  // 이전 날의 축제
                for($day = 1; $day <= date("d", $time__last_day); $day++):
                    $events = [null, null, null];                   // i가 가리키는 날에 포함된 축제
                    $started = array_filter($schedules, function($event){
                        global $day;
                        return $event->start_date == $day;          // i가 가리키는 날에 시작한 축제
                    });

                    if($prev_events)                                
                        foreach($prev_events as $idx => $item){     // 이전 날의 포함되었던 축제가 있다면, 동일한 인덱스에 다시 저장함
                            if($item && $item->start_date <= $day && $day <= $item->end_date) $events[$idx] = $item;
                            else $events[$idx] = null;              // 이전 날에 포함된 축제가 종료되면 그 자리는 비게 만듦
                        }
                        
                    foreach($started as $item){                     // 축제 공간 3개 중 빈자리(NULL)이 있다면 오늘 시작한 축제를 3개까지 넣는다.
                        for($j = 0; $j < 3; $j++){
                            if($events[$j] === null){
                                $events[$j] = $item;
                                break;
                            }
                        }
                    }
            ?>
                <div class="calender__item <?= date("Y-m", $time__first_day) == date("Y-m") && $day == date("d") ? 'calender__item--current': '' ?>">
                    <span class="calender__no"><?=$day?></span>
                    <div class="event">
                        <?php foreach($events as $event):?>
                            <?php if(!$event):?>
                                <div class="event__item event__item--empty"></div>
                            <?php else:?>
                                <a href="/festivals/<?=$event->id?>" class="event__item"><?=(!isset($prev_events) || array_search($event, $prev_events) === false) && $event ? $event->name. " ({$event->period})" : ''?></a>
                            <?php endif;?>
                        <?php endforeach;?>
                    </div>
                </div>    
            <?php 
                $prev_events = $events;
            ?>
            <?php endfor;?>
            <?php for($i = 0; $i < 6 - date("w", $time__last_day); $i++):?>
                <div class="calender__item calender__item--empty"></div>
            <?php endfor;?>
        </div>
    </div>
</div>