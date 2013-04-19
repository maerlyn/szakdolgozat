$(document).ready(function () {
    $("#jegyzokonyv_elemek").sortable({
        containment: "parent",
        tolerance: "pointer"
    });

    $(document).on("click", ".closebtn", function (e) {
        $(this).closest(".jegyzokonyvelem").remove();
        e.preventDefault();
    });
});
