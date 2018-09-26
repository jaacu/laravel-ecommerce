
$(function () {
    /**
     * A global logout form submit for the repeated logout buttons in the navbar, sidebar, etc.
     */
    $('.logoutButton').click(function(e){
        $('#logoutForm').submit();
    e.preventDefault();
    })

    /**
     * Show the notification after the page is loaded then hide after 5 seconds with animations 
     */
    $('.normal-notification').delay(500).slideDown().delay(5000).slideUp();
})