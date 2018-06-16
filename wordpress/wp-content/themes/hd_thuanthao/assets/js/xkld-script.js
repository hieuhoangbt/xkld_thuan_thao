$(document).ready(function () {
    var pppRecruitment = 3; // Post per page
    var pageNumberRecruitment = 1;

    var pppPost = 1; // Post per page
    var pageNumberPost = 1;


    function load_recruitment() {
        pageNumberRecruitment++;
        var str = '&pageNumber=' + pageNumberRecruitment + '&ppp=' + pppRecruitment + '&action=more_recruitment_ajax';
        $.ajax({
            type: "POST",
            dataType: "html",
            url: ajax_recruitment.ajaxurl,
            data: str,
            success: function (res) {
                var $data = $(res);
                if ($data.length) {
                    $($data).insertAfter('#recruitment-append');
                    $(".recruitment-load-more").attr("disabled", false);
                } else {
                    $(".recruitment-load-more").attr("disabled", true);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }

        });
        return false;
    }

    $(".recruitment-load-more").on("click", function (e) { // When btn is pressed.
        e.preventDefault();
        $(".recruitment-load-more").attr("disabled", true); // Disable the button, temp.
        load_recruitment();
    });

    function load_post() {
        pageNumberPost++;
        var str = '&pageNumber=' + pageNumberPost + '&ppp=' + pppPost + '&action=more_post_ajax';
        $.ajax({
            type: "POST",
            dataType: "html",
            url: ajax_recruitment.ajaxurl,
            data: str,
            success: function (res) {
                var $data = $(res);
                if ($data.length) {
                    $($data).insertAfter('#news-append');
                    $(".news-load-more").attr("disabled", false);
                } else {
                    $(".news-load-more").attr("disabled", true);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }

        });
        return false;
    }

    $(".news-load-more").on("click", function (e) { // When btn is pressed.
        e.preventDefault();
        $(".news-load-more").attr("disabled", true); // Disable the button, temp.
        load_post();
    });
});