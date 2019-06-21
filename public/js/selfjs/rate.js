function set(id)
{
    for(var i=1; i<=5; i++)
    {
        var star = 'star' + i;
        document.getElementById(star).style.color = '#333';
    }
    for (var i = 1; i <= id; i++)
    {
        var star = 'star' + i;
        document.getElementById(star).style.color = '#fbd600';
    }
     
    document.getElementById('star').value = id;
}

$('.rate_submit').click(function(e){
    var token = $('meta[name="csrf-token"]').attr('content');
    var slug = $('.slug').val();
    var point = $('.point').val();
    var review = $('.review').val();
    var options = {
        dataType: 'json',
        url: '/rates',
        method: 'POST',
        data: {
            slug: slug,
            point: point,
            review: review,
            _token: token,
        },

        success:function(response){
            if (parseInt(response.flag) != 0)
            {
                $('.review_list').append(response.html);
            }

            if (response.new_avgPoint)
            {
                $('.avgPoint').html(response.new_avgPoint);
            }

            if (response.review_count)
            {   
                $('.review_count').html('('+response.review_count+' Reviews)');
            }

            $('#error_msg').html(response.message);
        },

        error:function(){
            $('#error_msg').html('Please login before review');
        }
    }
    
    e.preventDefault();
    $.ajax(options);
});
