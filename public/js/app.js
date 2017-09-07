window.onload = function () {
    var reload =document.getElementsByClassName("reload");
    TweenMax.to(reload, 1, {rotation: "360", repeat:"1" });



};
window.load = function () {
    reload =document.getElementsByClassName("reload");
    TweenMax.to(reload, 1, {display: "none" });


};