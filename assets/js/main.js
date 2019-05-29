$(document).ready(function () {
    $('.sidenav').sidenav();
    setTimezone();

    function setTimezone() {
        //Returns the number of minutes ahead or behind greenwich meridian
        let offset = new Date().getTimezoneOffset();
        //Returns the number of milliseconds since 1970/01/01
        let timestamp = new Date().getTime();
        //Convert the time coordinated/universally coordinated time
        let utc_timestamp = timestamp + (60000 * offset);

        $("#timestamp").val(utc_timestamp);
        $("#offset").val(offset);
    }
})