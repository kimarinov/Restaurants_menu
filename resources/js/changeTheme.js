var toggle_icon = document.getElementById('theme-toggle');
var body = document.getElementsByTagName('body')[0];
var sun_class = 'fas fa-sun';
var moon_class = 'fas fa-moon';
var dark_theme_class = 'dark-theme';

function toogle(){
    if (document.getElementsByTagName('body')[0].classList.contains(dark_theme_class)) {
        document.getElementsByTagName('body')[0].classList.remove(dark_theme_class);
        console.log('ddz');
        setCookie('theme', 'light');
    }else{
        document.getElementsByTagName('body')[0].classList.add(dark_theme_class);
        setCookie('theme', 'dark');
    }
}
// if (toggle_icon){
//   toggle_icon.addEventListener("click", toogle);
// }
function setCookie(name, value) {
    var d = new Date();
    d.setTime(d.getTime() + (365*24*60*60*1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}
