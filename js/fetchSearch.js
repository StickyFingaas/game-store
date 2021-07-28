$(document).ready(function() {
    $("#search_text").keyup(function() {
        var txt = $(this).val();
        if (txt != '') {
            $.ajax({
                url: 'loadSearch.php',
                method: 'post',
                data: { search: txt },
                dataType: "text",
                beforeSend: function() {
                    $("#results").slideUp('fast');
                },
                success: function(data) {
                    $("#results").html(data);
                    $("#results").slideDown('fast');
                }
            });
        }
    });
});