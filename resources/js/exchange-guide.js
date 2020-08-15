class App {
    constructor(){
        this.$readmore = $("#read-more");
        this.$content = $("#exchange-content");

        this.getExchangeList().then(exchangeList => {
            this.exchangeList = exchangeList;
            this.viewList = [];
            
            this.loadData();
            this.render();
            this.setEvents();
        });
    }   

    /**
     * 환율 정보 가져오기
     */
    getExchangeList(){
        return fetch("/api/exchange-rate")
        .then(res => res.json())
        .then(res => res.items);
    }

    /**
     * LocalStorage 저장하기
     */
    saveData(){
        let saveList = {
            viewList: this.viewList,
            exchangeList: this.exchangeList,
            lastScroll: window.scrollY
        }
        localStorage.setItem("exchange-guide", JSON.stringify(saveList));
    }

    /**
     * LocalStorage 불러오기
     */
    loadData(){
        let ls_data = localStorage.getItem("exchange-guide");
        if(ls_data){
            let data = JSON.parse(ls_data);
            this.exchangeList = data.exchangeList;
            this.viewList = data.viewList;

            let lastScroll = parseInt(data.lastScroll);
            setTimeout(() => {
                window.scrollTo(0, lastScroll);
            });
        }
    }


    /**
     * DOM 정보 갱신하기
     */
    render(){
        this.viewList.push( ...this.exchangeList.splice(0, 10) );

        this.$content.html(`<button id="read-more" class="btn-filled" ${this.exchangeList.length === 0 ? 'hidden' : ''}>더 보기 <i class="fa fa-plus ml-2"></i></button>`);
        this.viewList.forEach(item => {
            let elem = $(`<div class="exchange-item ${item.result !== 1 ? 'active' : ''}">
                <div class="fx-5 font-weight-bold">${item.cur_nm}</div>
                <hr>
                <div class="t-row text-left">
                    <div class="cell-30 fx-n2 text-muted">통화코드</div>
                    <div class="cell-70">${item.cur_unit}</div>
                </div>
                <div class="t-row text-left">
                    <div class="cell-30 fx-n2 text-muted">송금 시</div>
                    <div class="cell-70">${item.ttb}</div>
                </div>
                <div class="t-row text-left">
                    <div class="cell-30 fx-n2 text-muted">수금 시</div>
                    <div class="cell-70">${item.tts}</div>
                </div>
                <div class="t-row text-left">
                    <div class="cell-30 fx-n2 text-muted">매매 기준율</div>
                    <div class="cell-70">${item.deal_bas_r}</div>
                </div>
                <div class="t-row text-left">
                    <div class="cell-30 fx-n2 text-muted">장부가격</div>
                    <div class="cell-70">${item.bkpr}</div>
                </div>
                <div class="t-row text-left">
                    <div class="cell-30 fx-n2 text-muted">년환가료율</div>
                    <div class="cell-70">${item.yy_efee_r}</div>
                </div>
                <div class="t-row text-left">
                    <div class="cell-30 fx-n2 text-muted">10일환가료율</div>
                    <div class="cell-70">${item.ten_dd_efee_r}</div>
                </div>
                <div class="t-row text-left">
                    <div class="cell-30 fx-n2 text-muted">매매 기준율</div>
                    <div class="cell-70">${item.kftc_bkpr}</div>
                </div>
                <div class="t-row text-left">
                    <div class="cell-30 fx-n2 text-muted">장부가격</div>
                    <div class="cell-70">${item.kftc_deal_bas_r}</div>
                </div>
            </div>`)[0];
            this.$content[0].insertBefore(elem, this.exchangeList.length > 0 ? $("#read-more")[0] : null);
        }); 
    }

    /**
     * 이벤트 설정하기
     */
    setEvents(){
        $(window).on("scroll", e => {
            let scrollBottom = window.innerHeight + window.scrollY;

            if(document.body.offsetHeight === scrollBottom) this.render();
            this.saveData();
        });

        this.$content.on("click", "#read-more", e => {
            this.render();
            this.saveData();
        });
    }
}


$(function(){
    let app = new App();
});
