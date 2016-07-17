$("table")
    .on("click focus", ".item.inactive", function(e) {
        var curRow = $(".item.inactive"); 
        curRow.clone().appendTo("table tbody");
        curRow.removeClass("inactive").find("input:first").focus();
    })
    .on("click", ".icon.delete", function(e) {
        $(this).closest("tr").remove();
    });

$("button").on("click", function(e) {
    $(".item.inactive").click().find("input:first").focus();
});