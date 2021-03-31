$('#save').on('click', function() {
    let name = $('#name').val().trim();
    let surname = $('#surname').val().trim();
    let age = $('#age').val().trim();

    $('span, .success').addClass('none');

    $.ajax({
        url: "handlers/save.php",
        type: "POST",
        dataType: "json",
        data: {
            name: name,
            surname: surname,
            age: age
        },
        success: function(data) {
            if (data.errorFields) {
                for (field in data.errorFields) {
                    $('span.' + field).removeClass('none').text(data.errorFields[field]);
                };
            } else {
                $('#name').val('');
                $('#surname').val('');
                $('#age').val('');
                $('.success').removeClass('none').text(data.success);
            }
        }
    });
});
