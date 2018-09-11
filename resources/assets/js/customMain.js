
$(function () {
    $('.logoutButton').click(function(e){
        $('#logoutForm').submit();
    e.preventDefault();
    })

    $('#errorNotification').delay(500).slideDown().delay(5000).slideUp();
})