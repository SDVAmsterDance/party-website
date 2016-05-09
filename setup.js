// load some jquery shit (plugin)
$.fn.textWidth = function(_text, _font){//get width of text with font.  usage: $("div").textWidth();
    var fakeEl = $('<span>').hide().addClass("txtwidth").appendTo(document.body).text(_text || this.val() || this.text()).css('font', _font || this.css('font')),
    width = fakeEl.outerWidth();
    fakeEl.remove();
    return width;
};

// resize element based on content size, or placeholder if empty
$.fn.autoresize = function(options){//resizes elements based on content size.  usage: $('input').autoresize({padding:10,minWidth:0,maxWidth:100});
    options = $.extend({padding:0,minWidth:0,maxWidth:10000}, options||{});
    $(this).on('input', function() {
        // also take into account the placeholder
        if ($(this).val() == "") $(this).css('width', $.fn.textWidth.call($(this), $(this).attr('placeholder')));
        else $(this).css('width', Math.min(options.maxWidth,Math.max(options.minWidth,$(this).textWidth() + options.padding)));
        // correct the apply button position AGAIN
        $(".stories").height($("#story-form").outerHeight());
    }).trigger('input');
    return this;
};

// function to calculate a new price
function fixPrice() {
    // this holds whether or not the buyer is a member
    member = $("#buyer-member").val();
    vip = $("#buyer-vip").val();

    // 12,50 is the base price
    price = 1250;

    // amsterdance members pay 5 euros less but vips 5 euros more.
    if (member == "2") price -= 500;
    if (vip == "2") price += 750;

    // set the pprice in the correct field.
    $("#price-value").text((price / 100).toFixed(2));
}

// function to fix the guest list for a buyer
function fixGuests() {
    // update whether or not it says guest or guests
    $("#guests").text($("#buyer-guests").val() > 1 ? "s" : "");


}

// function to validate the form and make sure every value is ok
function checkForm() {
    // TODO, check the form and validate correctness. Return false if incorrect and supply some feedback, otherwise true.
    return true;
}
