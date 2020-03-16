$(document).ready(function(){
    $('.fileBtn').on('change',function () {
        console.log('ok');
        readURL(this);
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
function changeStatus(status, id){
   $.ajax({
       url:'status',
       type:'Get',
       data:{
           id:id,
           status:status
       },
        success: function(){
            console.log('ok');
        }
   });
}