$(document).ready( function () {
    $('#star').raty({
        half:  true,
        path: '../img/',
        starHalf:   'star-half-big.png',
        starOff:    'star-off-big.png',
        starOn:     'star-on-big.png',
        size:       24,
        click: function (score, evt) {
            console.log(score);
        }
    });
    $.fn.stars = function() {
        return $(this).each(function() {
            // Get the value
            var val = parseFloat($(this).html());
            // Make sure that the value is in 0 - 5 range, multiply to get width
            var size = Math.max(0, (Math.min(5, val))) * 16;

            if(size == 0){
                var span_min = $('<span class="star_off" />').width(80);
                $(this).html(span_min);
            }else if(size == 100){
                var span_max = $('<span class="star_on" />').width(80);
                $(this).html(span_max);
            }else{
                var val_on = parseInt(val);
                var span_on = $('<span class="star_on" />').width(16*val_on);
                $(this).html(span_on);
                var val_off = 5- val_on;
                console.log(val_on);
                console.log(val_off);
                if(isFloat(val)){
                    console.log('ok');
                    var span_half = $('<span class="star_half" />').width(16);
                    $(this).append(span_half);
                    val_off--;
                }
                var span_off = $('<span class="star_off" />').width(16*val_off);
                $(this).append(span_off);
            }
        });
    }
    $(function() {
        $('span.stars').stars();
    });
});
function isFloat(n){
    return Number(n) === n && n%1 !== 0;
}
