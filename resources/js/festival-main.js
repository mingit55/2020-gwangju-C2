const PAGE_BLOCK = 5;
const PAGE_LIST = 10;
const PAGE_ALBUM = 6;

const VIEW_LIST = 1;
const VIEW_ALBUM = 2;

class App {
    constructor(){
        this.$viewModal = $("#view-modal");
        this.$content = $(".f-tab__content");
        this.$pagination = $(".pagination");

        this.getFestivalList().then(festivalList => {
            this.festivalList = festivalList;

            this.update();
            this.setEvents();
        });
    }

    /**
     * 현재 페이지 순서 가져오기
     */
    get page(){
        let qstr = location.getQueryString();
        let page = parseInt(qstr.page);
        return isNaN(page) || !page || page <= 0 ? 1 : page;
    }

    /**
     * 현재 검색 타입 가져오기
     */
    get viewType(){
        let qstr = location.getQueryString();
        let viewType = parseInt(qstr['view-type']);
        return [VIEW_ALBUM, VIEW_LIST].includes(viewType) ? viewType : VIEW_LIST;
    }

    /**
     * 축제 데이터 가져오기
     */
    getFestivalList(){
        return fetch("/api/festival-list")
        .then(res => res.json())
        .then(res => res.festivals);
    }

    /**
     * 페이지 갱신
     */
    update(){
        // 탭 갱신
        $(".f-tab__item.active").removeClass("active");
        $("[data-id='"+this.viewType+"'].f-tab__item").addClass("active");

        
        // 페이지네이션 갱신
        let page_unit = this.viewType == VIEW_ALBUM ? PAGE_ALBUM : PAGE_LIST;
        let total_page = Math.ceil(this.festivalList.length / page_unit);
        let current_block = Math.ceil(this.page / PAGE_BLOCK);

        let start = current_block * PAGE_BLOCK - PAGE_BLOCK + 1;
        let end = start + PAGE_BLOCK - 1;

        
        if(start - 1 < 1) {
            start = 1;
        }
        if(end + 1 > total_page) {
            end = total_page;
        }        

        let pageList = [];
        for(let i = start; i <= end; i++){
            pageList.push(`<a href="?view-type=${this.viewType}&page=${i}" class="pagination__link ${i == this.page ? 'active' : ''}">${i}</a>`);
        }
        this.$pagination.html(`<a href="?view-type=${this.viewType}&page=${start - 1 < 1 ? 1 : start - 1}" class="pagination__blink">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                ${pageList.join('')}
                                <a href="?view-type=${this.viewType}&page=${end + 1 > total_page ? total_page : end + 1}" class="pagination__blink">
                                    <i class="fa fa-angle-right"></i>
                                </a>`);

        let sp = (this.page - 1) * page_unit;
        let ep = sp + page_unit;
        let viewList = this.festivalList.slice(sp, ep);


        // 게시물 갱신
        this.$content.html("");
        if(this.viewType === VIEW_LIST) this.viewByList(viewList);
        else if(this.viewType === VIEW_ALBUM) this.viewByAlbum(viewList);
    }

    viewByAlbum(viewList){
        let lastItem = this.festivalList[this.festivalList.length - 1];
        let htmlList = viewList.map(item => `<div class="col-lg-4 col-6 mb-4">
                                                <div class="f-item border" data-target="#view-modal" data-toggle="modal" data-id="${item.id}">
                                                    <span class="f-item__count">${item.images.length}</span>
                                                    <img class="f-image fit-cover" height="250" src="${item.imagePath}/${item.images[0] ? item.images[0] : ''}" alt="No image">
                                                    <div class="p-3">
                                                        <div class="fx-2 font-weight-bold">${item.name}</div>
                                                        <div class="fx-n2 text-muted mt-2">${item.period}</div>
                                                    </div>
                                                </div>
                                            </div>`);
        this.$content.html(`<div class="f-tab__area gallery">
                                <div class="f-main" data-target="#view-modal" data-toggle="modal" data-id="${lastItem.id}">
                                    <div class="row align-item-start">
                                        <div class="col-lg-5">
                                            <img src="${lastItem.imagePath}/${lastItem.images[0] ? lastItem.images[0] : ''}" alt="No image" height="250" class="fit-cover f-image">
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="fx-n1 text-muted mb-2">대표 축제</div>
                                            <div class="fx-4 font-weight-bold">${lastItem.name}</div>
                                            <div class="mt-5">
                                                <span class="text-muted fx-n2">기간</span>
                                                <span class="fx-n1 ml-3">${lastItem.period}</span>
                                            </div>
                                            <div class="mt-3 fx-n2 text-muted">
                                                ${lastItem.content}
                                            </div>
                                            <button class="btn-filled mt-4">
                                                자세히 보기
                                                <i class="fa fa-angle-right ml-2"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <hr class="mx-auto my-5">
                                <div class="f-list">
                                    <div class="row">
                                        ${htmlList.join('')}
                                    </div>
                                </div>
                            </div>`);
        this.$content.find(".f-image").on("error", e => {
            $(e.target).siblings(".f-item__count").remove();
            $(e.target).attr("src", "/resources/images/no-image.png");
        });
    }

    viewByList(viewList){
        let htmlList = viewList.map(item => `<div class="t-row" data-target="#view-modal" data-toggle="modal" data-id="${item.id}">
                                                <div class="cell-10">${item.no}</div>
                                                <div class="cell-50 text-left text-ellipsis px-2">${item.name}</div>
                                                <div class="cell-30">${item.period}</div>
                                                <div class="cell-10">${item.area}</div>
                                            </div>`)
        this.$content.append(`<div class="f-tab__area list">
                                <div class="t-head">
                                    <div class="cell-10">번호</div>
                                    <div class="cell-50">제목</div>
                                    <div class="cell-30">기간</div>
                                    <div class="cell-10">장소</div>
                                </div>
                                ${htmlList.join('')}
                            </div>`);
    }

    /**
     * 이벤트 설정
     */
    setEvents(){
        // 모달 이벤트     
        $("[data-target='#view-modal']").on("click", e => {
            let festival = this.festivalList.find(festival => festival.id == e.currentTarget.dataset.id);
            
            this.$viewModal.data("sno", 1);
            this.$viewModal.find(".name").text(festival.name);
            this.$viewModal.find(".area").text(festival.area);
            this.$viewModal.find(".location").text(festival.location);
            this.$viewModal.find(".period").text(festival.period);
            this.$viewModal.find(".content").text(festival.content);
            
            this.$viewModal.find(".f-image").attr("src", festival.imagePath+"/"+festival.images[0]);

            this.$viewModal.find(".f-slide__inner").css({
                left: "0",
                width: 100 * festival.images.length + "%"
            });
            let imagesHTML = festival.images.map(image => `<img style="width: calc(100% / ${festival.images.length})" src="${festival.imagePath}/${image}" alt="No image"/>`);
            this.$viewModal.find(".f-slide__inner").html(imagesHTML);

            let controlHTML = "";
            for(let i = 1; i <= festival.images.length; i++)
                controlHTML += `<button class="f-control__abs" data-value="${i}">${i}</button>`;
            this.$viewModal.find(".f-control").html(`<button class="f-control__rel" data-value="-1" disabled><i class="fa fa-angle-left"></i></button>
                                                    ${controlHTML}
                                                    <button class="f-control__rel" data-value="1"><i class="fa fa-angle-right"></i></button>`);
            this.$viewModal.find(".f-control > button:nth-child(2)").addClass("active");
        });

        $(".f-control").on("click", ".f-control__rel", e => {
            let value = parseInt(e.currentTarget.dataset.value);
            let sno = parseInt(this.$viewModal.data("sno"));
            let images = this.$viewModal.find(".f-slide__inner > img");
            let btns = this.$viewModal.find(".f-control > button");

            this.$viewModal.data("sno", sno + value);
            this.$viewModal.find(".f-slide__inner").css("left", (sno + value - 1) * -100 + "%")

            btns.removeClass("active");
            btns.removeAttr("disabled");
            btns.eq(sno + value).addClass("active");

            if(sno + value - 1 < 1) btns.first().attr("disabled", "disabled");
            else if(sno + value + 1 > images.length) btns.last().attr("disabled", "disabled");
        });
        
        $(".f-control").on("click", ".f-control__abs", e => {
            let value = parseInt(e.currentTarget.dataset.value);
            let images = this.$viewModal.find(".f-slide__inner > img");
            let btns = this.$viewModal.find(".f-control > button");

            this.$viewModal.data("sno", value)
            this.$viewModal.find(".f-slide__inner").css("left", (value - 1) * -100 + "%")
            
            btns.removeClass("active");
            btns.removeAttr("disabled");
            btns.eq(value).addClass("active");

            if(value - 1 < 1) btns.first().attr("disabled", "disabled");
            else if(value + 1 > images.length) btns.last().attr("disabled", "disabled");
        });

    }
}

$(function(){
    let app = new App();
});