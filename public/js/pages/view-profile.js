"use strict";
$(document).ready(function() {
    $(function () {
        $("input[name$='options']").change(function() {
            var test = $(this).val();
            $('.jqueryOptions').hide();
            $('.jqueryOptions').removeClass("d-none");
            $(".jqueryOptions." + test).show();
        });
    });

    $(".list-group-item").click( function() {
        fetchUser($(this).text());
        $('#showAllUsersModal').modal('hide');
    });
});
