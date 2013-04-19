$(document).ready(function () {
    $("#jegyzokonyv_elemek").sortable({
        containment: "parent",
        tolerance: "pointer"
    });

    $(document).on("click", ".closebtn", function (e) {
        e.preventDefault();

        $(this).closest(".jegyzokonyvelem").remove();
    });

    $(".uj_jegyzokonyvelem").click(function (e) {
        e.preventDefault();

        var $tipus = $(this).data("tipus");
        var $template = $("#" + $tipus + "_template").html();
        $template = $template.replace(/IDE_JON_AZ_ID/g, --$kovetkezo_elem);

        $("#jegyzokonyv_elemek").append($template);
    });
});
