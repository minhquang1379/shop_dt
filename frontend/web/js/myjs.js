$(document).ready(function () {
    blogId = $('#blogId').val();
    userId = $('#userId').val();
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
    function isFloat(n){
        return Number(n) === n && n%1 !== 0;
    }
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
    //click select avatar customer
    $('.fileBtn').on('change',function () {
        console.log('ok');
        readURL(this);
    });
    //click send comment
    $('.btn-enter').on('click',function () {

    });
    //see more
    $('.see_more_0').on('click',function () {
        console.log('ok');
        count = $('#countComment_0').val();
        display = $('#displayComment_0').val();
        ajaxSeeMoreComment(blogId, count, display);
    });
    //show reply form
    $('.btnReply').on('click', function(){
        replyBtn = $(this);
        parentId = $(this).attr('id');
        parent1 = $(this).parent().parent();
        parent2 = $(parent1).parent();
        parentFinal = $(parent2).parent();
        ajaxReply(parentId,replyBtn, parentFinal);
    });
    pusherInit();
    $(document).on('click','.btn-enter', function () {
        console.log('ok');
        parent = $(this).parent();
        test_input = $(this).prev().prev('.comment_area');
        content = $(test_input).val();
        parentId = $(this).attr('id');
        if(content !== ''){
            ajaxCreateComment(blogId, userId, content, parentId, test_input);
        }
    })
});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('.img-select').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
function incrementCount(){
    count = $('#countComment_0').val();
    count++;
    $('#countComment_0').val(count);

    countDisplay = $('#displayComment_0').val();
    countDisplay++;
    $('#displayComment_0').val(countDisplay);
}
function pusherInit(){
    Pusher.logToConsole = true;

    var pusher = new Pusher('d5057080fd4987bf00fe', {
        cluster: 'ap1',
        forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        useId = $('#userId').val();
        blogId = $('#blogId').val();
        if(userId != data.userId){
            if(data.parentId == '' && blogId == data.blogId){
                $('#commentList_0').append(data.view);
                incrementCount();
            }
        }
    });
}
function ajaxCreateComment(blogId, userId, content, parentId, test_input){
    $.ajax({
        url:'../comment/create',
        type: 'GET',
        dataType:'html',
        data:{
            blogId:blogId,
            userId: userId,
            content:content,
            parentId:parentId,
        },
        success: function (data) {
            $('#commentList_'+parentId).append(data);
            $(test_input).val('');
            incrementCount();
        }
    });
}
function ajaxSeeMoreComment(blogId, count, display){
    $.ajax({
        url:'../comment/more',
        type:'GET',
        data:{
            blogId:blogId,
            count:count,
            display:display
        },
        success:function (data) {
            $('#commentList_0').prepend(data);
            $('#displayComment_0').val(Number(display) + 5);
            temp = count%5;
            if(temp == 0){
                check = count -  Number(display) + 5;
            }else{
                check = count -  Number(display);
            }
            if(check <= 0){
                $('.see_more_0').html('');
                $('.see_more_0').attr('class','');
            }
        }
    });
}
function ajaxReply(parentId,replyBtn, parentFinal){
    $.ajax({
        url:'../comment/form',
        type:'GET',
        data:{
            parentId: parentId
        },
        success:function (data) {
            $(replyBtn).remove();
            parentFinal.append(data);
        }
    });
}

