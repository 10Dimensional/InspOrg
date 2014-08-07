
//Mikes shrink header
function init() {
    window.addEventListener('scroll', function(e){
        var distanceY = window.pageYOffset || document.documentElement.scrollTop,
            shrinkOn = 100,
            header = document.querySelector("header");
        if (distanceY > shrinkOn) {
        	classie.remove(header, "header-large");
            classie.add(header,"header-shrinked");
        } else {
            if (classie.has(header,"header-shrinked")) {
                classie.remove(header,"header-shrinked");
                classie.add(header,"header-large");
            }
        }
    });
}
window.onload = init();