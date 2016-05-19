//--Film Info
jQuery(document).ready(function () {
    // rating
    var filmId = jQuery("#film_id").val();

    function scorehint(score) {
        var text = "";
        switch (parseInt(score)) {
            case 1:
                text = "Dở tệ";
                break;
            case 2:
                text = "Dở";
                break;
            case 3:
                text = "Không hay";
                break;
            case 4:
                text = "Không hay lắm";
                break;
            case 5:
                text = "Bình thường";
                break;
            case 6:
                text = "Xem được";
                break;
            case 7:
                text = "Có vẻ hay";
                break;
            case 8:
                text = "Hay";
                break;
            case 9:
                text = "Rất hay";
                break;
            default:
                text = "Tuyệt vời";
        }
        return text;
    }

    jQuery('#star').raty({
        half:false,
        noRatedMsg:"Bạn đã thực hiện đánh giá phim này",
        score:function () {
            return jQuery(this).attr('data-score');
        },

        mouseover:function (score, evt) {
            //jQuery("#hint").html(scorehint(score));
        },
        mouseout:function (score, evt) {
            jQuery("#hint").html("");
        },
        click:function (score, evt) {
            jQuery.ajax({
                'url':'/film/rate/' + filmId,
                'type':'POST',
                'dataType':'JSON',
                'data':{'score':score}
            }).done(function (data) {
                    if (data.status) {
                        if (typeof data.ratePoint != 'undefined') {
                            jQuery('.box-rating .average').html(data.ratePoint);
                            jQuery('.box-rating #rate_count').html(data.rateCount);
                            jQuery('.box-rating #average').html(data.ratePoint);
                            jQuery('.box-rating #div_average').show();
                            $('#star').raty('score', data.ratePoint);
                            jQuery("#hint").html("");
                            $('#star').raty('readOnly', true);
                        }
                    } else {
                        $('#star').raty('readOnly', true);
                    }
                    //auto if _fxStatus==0
                });
        }
    });
    if (filmId) {
        jQuery.ajax({
            'url':'/film/getRate/' + filmId,
            'type':'POST',
            'dataType':'JSON'
        }).done(function (data) {
                if (data.status) {
                    if (typeof data.ratePoint != 'undefined') {
                        jQuery('.box-rating .average').html(data.ratePoint);
                        jQuery('.box-rating #rate_count').html(data.rateCount);
                        jQuery('.box-rating #average').html(data.ratePoint);
                        jQuery('.box-rating #div_average').show();
                        $('#star').raty('score', data.ratePoint);
                        if (data.status == 1) {
                            $('#star').raty('readOnly', true);
                        }
                    }
                }
                //auto if _fxStatus==0
            });
        if(false && $('#box-list-comment').size() > 0) {
            jQuery.ajax({
                'url':'/comment/list/' + filmId,
                'type':'GET'
            }).done(function (data) {
                    if (data) {
                        $('#box-list-comment ul').html(data);
                    }
                });
        }

        $( "#form_comment" ).submit(function( event ) {
            var comment = $('#comment_comment').val();
            if(comment.length > 10) {
                $("#form_comment .message").addClass('loading').show();
                jQuery.ajax({
                    'url':'/comment/comment/' + filmId,
                    'type':'POST',
                    'data': {
                        comment: comment,
                        token: $('#comment_token').val()
                    }
                }).done(function (data) {
                        if(data.status == 1){
                            $("#form_comment .message").hide();
                            $('#box-list-comment ul').prepend(data.html);
                            $('#comment_comment').val('');
                        } else {
                            $("#form_comment .message").html('Bình luận không thành công, vui lòng thử lại!').show();
                        }
                        $("#form_comment .message").removeClass('loading');
                    });
            } else {
                alert('Bạn phải nhập ít nhất 10 ký tự!')
            }
            event.preventDefault();
        });
        $( "#box-list-comment" ).on('click', 'a.del-cmt', function() {
            var li = $(this).parent().parent();
            jQuery.ajax({
                'url':'/comment/delete/' + filmId,
                'type':'POST',
                'data': {
                    cid: li.attr('data-id')
                }
            }).done(function (data) {
                    if(data.status == 1){
                        li.remove();
                    }
                });
            return false;
        });
        $("#box-list-comment").on('click', '.view-more a', function() {
            var page = $(this).attr('data-page');
            jQuery.ajax({
                'url':'/comment/list/' + filmId,
                'type':'GET',
                'data': {
                    page: page
                }
            }).done(function (data) {
                    if (data) {
                        $("#box-list-comment .view-more").remove();
                        $('#box-list-comment ul').append(data);
                    }
                });
            return false;
        });
        $("#comment-tab ul.tab-comment li a").click(function() {
            if(!$(this).parent().hasClass('active')) {
                var divid = $(this).attr('href');
                $('#comment-tab > .box-comment').hide();
                $('#comment-tab '+divid).show();
                $("#comment-tab ul.tab-comment li").removeClass('active');
                $(this).parent().addClass('active');
            }
            return false;
        });
        if($("#comment-tab ul.tab-comment li.active").size() > 0) {
            var divid = $("#comment-tab ul.tab-comment li.active a").attr('href');
            $('#comment-tab .box-comment').hide();
            $('#comment-tab '+divid).show();
        }
    }
});