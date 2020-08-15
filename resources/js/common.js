location.getQueryString = function() {
    let idx = this.search.indexOf("?");
    let search = this.search.substr(idx + 1);
    return search.split("&").reduce((obj, item) => {
        let split = item.split("=");
        obj[split[0]] = split[1];
        return obj;
    }, {})
};

$(function(){
    $("[data-target='#road-modal']").on("click", e => {
        e.preventDefault();
        let timeout = false;
        fetch("/location.php")
            .then(res => res.text())
            .then(resText => {
                if(timeout == false) {
                    $("#road-modal .modal-body").html( $(resText) );
                    $("#road-modal").modal("show");
                    timeout = true;
                }
            });
        setTimeout(() => {
            if(timeout == false){
                alert("찾아오시는 길을 표시할 수 없습니다.");
                timeout = true;
            }
        }, 1000);
    });

    $(".custom-file-input").on("change", e => {
        if(e.target.files.length == 1){
            $(e.target).siblings(".custom-file-label").text(e.target.files[0].name);
        } else if(e.target.files.length > 1){
            $(e.target).siblings(".custom-file-label").text(e.target.files[0].name + " 외 " + (e.target.files.length - 1) + "개의 파일");
        } else {
            $(e.target).siblings(".custom-file-label").text("파일을 선택하세요");
        }
    }); 
});