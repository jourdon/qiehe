window.onload=function(){
    var storage = localStorage.getItem('AtSbd');
    if(!storage || JSON.stringify(JSON.parse(storage)[0]) ==="{}"){
        storage = new Array();
        localStorage.setItem('AtSbd',JSON.stringify(storage))
    }else{
        storage = JSON.parse(storage);
    }
    $.getJSON("/users_json", function(data) {
        if(JSON.stringify(data)==="{}"){
            return false;
        }
        if(!storage ||JSON.stringify(storage)==="{}") {
            console.log('赋值');
            storage = data;
        }else{
            console.log('合并');
            storage= $.uniqueSort(storage.concat(data));
        }
        localStorage.removeItem("AtSbd");
        localStorage.setItem('AtSbd',JSON.stringify(storage));
    });
    $('#reply-body').atwho({
        at: "@",
        data:null,
        callbacks: {
            remoteFilter: function (query, callback) {
                if(!storage ||JSON.stringify(storage[0]) ==="{}") {
                    console.log('api');
                    $.getJSON("/users_json", function(data) {
                        storage= data;
                        localStorage.removeItem("AtSbd");
                        localStorage.setItem('AtSbd',JSON.stringify(storage));
                        callback(data)
                    });
                } else {
                    console.log('cache');
                    callback(storage);
                }
            },
        },
    });
};

$('#reply-body').on("inserted.atwho", function(event, $li, browser_event) {
    var atName = $li[0].innerText;
    $.ajax({
        type: "GET",
        url: "/cache_at",
        data: {'name':atName},
        success: function(data){
            // console.log(data);
        }
    });
});
function OnInput(event){
    $('#preview-box').show();
    var converter = new showdown.Converter();
    var html = converter.makeHtml(event.target.value);
    $("#preview-box").html(html);
}