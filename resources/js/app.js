// Like button functionality
$('.like-btn').click(function () {
    const postId = $(this).data('id');
    $.post(`/posts/${postId}/like`, {_token: $('meta[name="csrf-token"]').attr('content')})
        .done(response => {
            $(this).text(`Like (${response.likes})`);
        })
        .fail(() => {
            alert('Error liking the post.');
        });
});

// Dislike button functionality
$('.dislike-btn').click(function () {
    const postId = $(this).data('id');
    $.post(`/posts/${postId}/dislike`, {_token: $('meta[name="csrf-token"]').attr('content')})
        .done(response => {
            $(this).text(`Dislike (${response.dislikes})`);
        })
        .fail(() => {
            alert('Error disliking the post.');
        });
});
