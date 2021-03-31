$('#unload').on('click', function() {
    $('span').addClass('none');

    $.ajax({
        url: "handlers/unload.php",
        cache: false,
        dataType: "json",
        success: function(data) {
            if (data.success) {
                $('.success')
                    .removeClass('none')
                    .text(data.success)
                    .append("<a class=\"results\" href=" + data.link + ">Посмотреть результаты -></a>");
            } else {
                $('.success').removeClass('none').addClass('no-results').text(data.message);
            }
        }
    });
});
