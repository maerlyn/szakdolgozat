$(document).ready(function () {
    $("#jegyzokonyv_elemek").sortable({
        containment: "parent",
        tolerance: "pointer"
    });

    $(document).on("click", ".closebtn", function (e) {
        e.preventDefault();

        var $id = $(this).closest(".jegyzokonyvelem").data("id");

        if ($id > 0) {
            var $input = $("<input type='hidden' name='toroltelemek[]' />").attr("value", $id);
            $("#jegyzokonyv_elemek").closest("form").append($input);
        }

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
