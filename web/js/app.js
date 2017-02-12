$(function(){
    $('#send-url-form').on("submit", function (e){
        e.preventDefault();
        var $form = $(this);

        $.ajax({
            url: '/api/links',
            success: function(response) {
                $('#result').text(response['url']);
            },
            method: 'post',
            data: $form.serialize(),
            dataType: 'json'
        });
    });
});