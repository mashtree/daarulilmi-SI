//for flash message
var Message = (function() {
    "use strict";

    var elem,
        that = {};
	
	elem = $('#message');
    that.show = function(text) {
        elem.find("span").html(text);
        elem.delay(200).fadeIn().delay(4000).fadeOut();
    };

    return that;
}());