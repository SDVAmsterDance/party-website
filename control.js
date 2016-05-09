$(function () {
    // fade in all the initial stuff
    // TODO

    // we enable auto-resizing
    $("input").autoresize();
    $("#buyer-guests").autoresize({padding: 30});

    // correct the apply button position
    $(".stories").children().each(function() { if (!$(this).hasClass("hidden")) $(".stories").height($(this).outerHeight()); });

    // install a click handler on the apply button, we want to do some nice stuff (make it look ncie)
    $("#apply-button").click(function(e) {
        // for now, we simply hide the initial story and the apply button
        $("#story-initial").addClass("hidden");
        $("#apply-button").addClass("hidden");

        // correct the apply button position AGAIN
        $(".stories").height($("#story-form").outerHeight());

        // we get out the form and submit button
        $("#story-form").removeClass("hidden")
        $("#submit-button").removeClass("hidden");
    });
    
    // install a click handler on the apply button, we want to do some nice stuff (make it look ncie)
    $("#submit-button").click(function(e) {
        // check the form and supply feedback
        if (!checkForm()) return;

        // for now, we simply hide the initial story and the apply button
        $("#story-form").addClass("hidden");
        $("#submit-button").addClass("hidden");

        // correct the apply button position AGAIN
        $(".stories").height($("#story-confimation").outerHeight());

        // we get out the form and submit button
        $("#story-confirmation").removeClass("hidden");

        // actually make the request.
        //TODO: backend
    });

    // fix the buyer accompanied sentence.
    $("#buyer-accompanied").on('change', function(e) {
        // if not accompanied, toggle out
        if ($(this).val() == "unaccompanied") {
            $("#accompanied-sentence").addClass("hidden");    
            $("#buyer-guests").val(0);    
            $("#accompanied-dot").removeClass("hidden");
        } else {
            $("#buyer-guests").val(1);    
            $("#accompanied-sentence").removeClass("hidden");    
            $("#accompanied-dot").addClass("hidden");
        }
    });
    
    // update the guest list otherwise
    $("#buyer-guests").on('change', function() { fixGuests(); });

    // entirely recalculate the price on any change
    $(".option").on('change', function(e) { fixPrice(); });
    
    // now that the handlers are setup, we can do some navigation
    if (window.location.hash != "#form") {
        // for now, we simply hide the initial story and the apply button
        $("#story-initial").removeClass("hidden");
        $("#apply-button").removeClass("hidden");
    } else {
        // the apply button is 'clicked' because we go to the form directly
        $("#apply-button").click();
    }

    // we want to set the initial price based on the options.
    fixPrice();
    fixGuests();
});

