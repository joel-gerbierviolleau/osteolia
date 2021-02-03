(function() {

    var cookieAlert = document.getElementById('cookieAlert')

    if (getCookie('cookie-opt-in')!==null && cookieAlert!==null) {
        document.getElementById('cookieAlert').remove();
    }
    if (cookieAlert !== null) 
    {
        cookieAlert.addEventListener('closed.bs.alert', function () {
            setCookie('cookie-opt-in','agreed', 365*24*60);
        })
    }

})()


//----------------------------------------------------------------------------------------
//  Cookies support function
//----------------------------------------------------------------------------------------
function setCookie(sName, sValue, sDuration) {
        var today = new Date(), expires = new Date();
        expires.setTime(today.getTime() + (sDuration*60*1000));
        document.cookie = sName + "=" + encodeURIComponent(sValue) + ";expires=" + expires.toUTCString();
}
function getCookie(sName) {
        var oRegex = new RegExp("(?:; )?" + sName + "=([^;]*);?");
 
        if (oRegex.test(document.cookie)) {
                return decodeURIComponent(RegExp["$1"]);
        } else {
                return null;
        }
}
function deleteCookie(sname) {
  document.cookie = sname + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}
