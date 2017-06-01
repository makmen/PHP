$(function(){ 							   

    // radiys box
    $('.menu_nav ul li a').css({"border-radius": "10px", "-moz-border-radius":"10px", "-webkit-border-radius":"10px"});
    $('.hbg').css({"border-radius": "0 20px 20px 0", "-moz-border-radius":"0 20px 20px 0", "-webkit-border-radius":"0 20px 20px 0"});
    $('.fbg').css({"border-radius": "20px", "-moz-border-radius":"20px", "-webkit-border-radius":"20px"});
    $('.pagenavi a, .pagenavi .current').css({"border-radius": "5px", "-moz-border-radius":"5px", "-webkit-border-radius":"5px"});
    $('a.rm, a.com').css({"border-radius": "5px", "-moz-border-radius":"5px", "-webkit-border-radius":"5px"});

    $('.files').on('click', '.del-file', function () {
        var id = $(this).data('id');
        var titleFile = $('.title-file' + id).html();
        if ( confirm('Вы действительно хотите удалить ' + titleFile ) ) {
            $.ajax({
                url: '/file/del-file',
                data: {id: id},
                type: 'GET',
                success: function (res) {
                    if (res) {
                        location.reload();
                    }
                },
                error: function () {
                    alert('Error!');
                }
            });
        }
    });
});
