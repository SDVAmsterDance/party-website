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
    
    // get the extra guests
    guests = $("#buyer-guests-input").children();
    
    // go over all the guests
    for (i = 0; i < guests.length; i++) {
        // add the price
        price += 1250;
        
        // this holds whether or not the buyer is a member
        member = $(guests[i]).find(".buyer-member").val();
        vip = $(guests[i]).find(".buyer-vip").val();
    
        // amsterdance members pay 5 euros less but vips 5 euros more.
        if (member == "2") price -= 500;
        if (vip == "2") price += 750;
    }

    // set the pprice in the correct field.
    $("#price-value").text((price / 100).toFixed(2));
}

// function to fix the guest list for a buyer
function fixGuests() {
    // get the amount
    amount = $("#buyer-guests").val();

    // update whether or not it says guest or guests
    $("#guests").text(amount > 1 ? "s" : "");

    // don't fix if nothing to fix, but clear the element
    if (amount == 0) {
        $("#buyer-guests-input").html("");
        return;
    }

    // get the template and the parent list
    el = $("#guest-template");
    elements = $("#buyer-guests-input");
    
    // check if the amount is equal to the neede amount, then do nothing
    if (amount == elements.children().length) return;
   
    // it can be less or more
    if (amount > elements.children().length) {
        // add children
        while (amount > elements.children().length) elements.append(el.clone().removeClass("invisible").removeClass("hidden"));
    } else {
        // remove last children until equal
        while (amount < elements.children().length) elements.children().last().remove();
    }
    
    // reinstall handlers because there are new elements now
    $(".option").on('change', function(e) { fixPrice(); });
    
    // also resize the new inputs
    $("input").autoresize();
    $("#buyer-guests").autoresize({padding: 30});

    // we need to fix the button again
    fixButton();
    fixPrice();
}

function fixButton() {
    // correct the apply button position
    $(".stories").children().each(function() { if (!$(this).hasClass("hidden")) $(".stories").height($(this).outerHeight()); });
}

// Validates email address of course.
function validEmail(e) {
     var filter = /^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/;
     return String(e).search (filter) != -1;
}

// function to validate the form and make sure every value is ok
function checkForm() {
    data = {guests: []};
    
    //Extract name, checking length and store in data. 
    name = $("#buyer-name").val();
    if (name.length == 0) { $("#buyer-name").addClass("error"); return false; }
    else $("#buyer-name").removeClass("error");
    data["name"] = name;
    
    // get the extra guests
    guests = $("#buyer-guests-input").children();
    
    // go over all the guests
    for (i = 0; i < guests.length; i++) {
        // this holds whether or not the buyer is a member
        name = $(guests[i]).find(".buyer-name").val();
        member = $(guests[i]).find(".buyer-member").val();
        vip = $(guests[i]).find(".buyer-vip").val();
        
        //Extract name, checking length and store in data. 
        if (name.length == 0) {$(guests[i]).find(".buyer-name").addClass("error"); return false;}
        else $(guests[i]).find(".buyer-name").removeClass("error");
        data["guests"].push({name: name, member: (member=="2"), vip: (vip=="2")});                
    }
    
    //Extract email, checking length and store in data. 
    email = $("#buyer-email").val();
    if (email.length == 0 || !validEmail(email))  { $("#buyer-email").addClass("error"); return false; }
    else $("#buyer-email").removeClass("error");
    data["email"] = email;

    //Extract if the buyer is a member or not and if he/she would like to be treated as a vip (and store in data)
    member = $("#buyer-member").val();
    vip = $("#buyer-vip").val();
    data["member"] = (member == "2");
    data["vip"] = (vip == "2");
    
    $.post('api/register.php', {data: JSON.stringify(data)}, function(data) {
        console.log(data);
    });
    
    return true;
}
