$(document).ready(function() {
    var count = 1;
    $("#btn").click(function() {
        count = count + 1;
        $("#containerData").load("loadData.php", {
            count: count
        });
    });
});