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
    //pusher init
    //trigger event in controller
    pusherInit();
    //click send comment
    $(document).on('click','.btn-enter', function () {
        console.log('ok');
        parent = $(this).parent();
        test_input = $(this).prev().prev('.comment_area');
        content = $(test_input).val();
        parentId = $(this).attr('id');
        if(content !== ''){
            ajaxCreateComment(blogId, userId, content, parentId, test_input);
        }
    });
    //see more
    $(document).on('click','.see_comment', function(){
        parentId =  $(this).attr('id');
        console.log(parentId);
        if(parentId == ''){
            count = $('#countComment_0').val();
            display = $('#displayComment_0').val();
        }else{
            count = $('#countComment_'+parentId).val();
            display = $('#displayComment_'+parentId).val();
        }
        ajaxSeeMoreComment(blogId, parentId, count, display);
    });
    //show reply form
    $(document).on('click','.btnReply',function () {
        replyBtn = $(this);
        parentId = $(this).attr('id');
        parent1 = $(this).parent().parent();
        parent2 = $(parent1).parent();
        parentFinal = $(parent2).parent();
        ajaxReply(parentId,replyBtn, parentFinal);
    });
    $(document).on('keyup','.comment_area', function (e) {
        if(e.keyCode == 13){
            val_input = $(this).val();
            parentId = $(this).attr('id');
            ajaxCreateComment(blogId, userId, val_input, parentId, this);
        }
    });
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
//increment display comment and quantity of comment
function incrementCount(){
    count = $('#countComment_0').val();
    count++;
    $('#countComment_0').val(count);

    countDisplay = $('#displayComment_0').val();
    countDisplay++;
    $('#displayComment_0').val(countDisplay);
}
//init pusher
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
        if(userId != data.userId  && blogId == data.blogId){
            if(data.parentId == ''){
                $('#commentList_0').append(data.view);
            }if(data.parentId !=''){
                child_length = $('#commentList_'+data.parentId).children('article').length;
                if(child_length != 0){
                    $('#commentList_'+data.parentId).append(data.view);
                }
            }
            incrementCount();
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
            if(parentId == ''){
                $('#commentList_0').append(data);
            }else{
                $('#commentList_'+parentId).append(data);
            }
            $(test_input).val('');
            incrementCount();
        }
    });
}
function ajaxSeeMoreComment(blogId, parentId,count, display){
    $.ajax({
        url:'../comment/more',
        type:'GET',
        data:{
            blogId:blogId,
            count:count,
            display:display,
            parentId:parentId
        },
        success:function (data) {
            if(parentId == ''){
                $('#commentList_0').prepend(data);
                $('#displayComment_0').val(Number(display) + 5);
            }else{
                parent = $('#commentList_'+parentId).parent();
                btnReply = $(parent).find('.btnReply')[0];
                commentId = $(btnReply).attr('id');
                if(parentId == commentId){
                    $(btnReply).click();
                }
                $('#commentList_'+parentId).prepend(data);
                $('#displayComment_'+parentId).val(Number(display) + 5);
            }
            temp = count%5;
            if(temp == 0){
                check = count -  Number(display) + 5;
            }else{
                check = count -  Number(display);
            }
            if(check <= 0){
                if(parentId == ''){
                    $('.see_more_0').html('');
                    $('.see_more_0').attr('class','');
                }else{
                    $('.see_more_'+parentId).html('');
                    $('.see_more_'+parentId).attr('class','');
                }

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
            textArea = $(parentFinal).find('.comment_area');
            $(textArea).focus();
        }
    });
}

