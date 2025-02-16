
let post_id;
$(document).ready(function () {
    $.ajax({
        url: 'postLoad.php',
        type: 'post',
        success: function (result) {
            $(".posts").html(result);
        }
    });

    $(".contact-friend").click(() => {
        console.log('done')
    });
});

$(document).ready(function () {
    $(".publish-post").click(function () {
        var fileInput = $('.file-input').prop('files')[0];
        var formData = new FormData();
        formData.append('post_txt', $(".publish textarea").val());
        formData.append('img', fileInput);
        $.ajax({
            url: 'postLoad.php',
            type: 'post',
            data: formData,
            success: function (r) {
                $(".posts").html(r);
            },
            cache: false,
            processData: false,
            contentType: false
        });
        $(".publish textarea").val("");
        $(".file-input").val("");
    })
})

$(document).ready(function () {
    $(".posts").on("click", "i.fa-comment", function (event) {
        post_id = event.target.id;
        $.ajax({
            url: 'loadComments.php',
            type: 'post',
            data: { post_id: post_id },
            success: function (result) {
                $(".comments .body").html(result);
            }
        })
        $(".comments").addClass('block');
        $(".black-opacity").addClass('add-opacity');
    });

    document.querySelector(".close i").addEventListener('click', function () {
        $(".comments").removeClass('block');
        $(".black-opacity").removeClass('add-opacity');
    })

    $(".black-opacity").click(function () {
        $(".comments").removeClass('block');
        $(this).removeClass('add-opacity');
        $(".messages-box").addClass('d-none');
    })

    document.querySelector(".addComments span i").addEventListener('click', function () {
        $.ajax({
            url: 'loadComments.php',
            type: 'post',
            data: { comment: $(".addComments .send_msg").val(), post_id: post_id },
            success: function (result) {
                $(".comments .body").html(result);
            }
        })
        $(".send_msg").val("");
    })

    $(".search").keyup(function () {
        if ($(this).val().length > 1) {
            $.ajax({
                url: 'search.php',
                type: 'post',
                data: { name: $(this).val() },
                success: function (result) {
                    $(".users-search").html(result);
                }
            })
            $(".users-search").removeClass("d-none");
        };
    });

    $(".main-content").click(function () {
        $(".users-search").addClass("d-none");
        $(".friend-requests").addClass("d-none");
    })

    $(".users-search").on("click", ".add-friend-btn", function () {
        $.ajax({
            url: 'search.php',
            type: 'post',
            data: { name: $(".search").val(), friend_id: this.id },
            success: function (result) {
                $(".users-search").html(result);
            }
        })
    });

    $(".fa-bell").click(function () {
        $(".friend-requests").removeClass("d-none");
        $.ajax({
            url: 'friend_requests.php',
            type: 'post',
            success: function (result) {
                $(".friend-requests").html(result);
            }
        });
    })

    $(".friend-requests").on("click", "button", function () {
        let statu;
        if ($(this).hasClass("cancel")) {
            statu = "cancel";
        } else {
            statu = "accept";
        }
        $.ajax({
            url: 'friend_requests.php',
            type: 'post',
            data: { friend_id: $(this).parent().attr('id'), statu_ajx: statu },
            success: function (result) {
                $(".friend-requests").html(result);
            }
        });
    })

    $.ajax({
        url: 'getFriends.php',
        type: 'post',
        success: (result) => {
            $(".messages-box .contacts").html(result);
        }
    });

    var friend_id;
    var count;

    $(".fa-facebook-messenger").click(() => {
        $(".messages-box").removeClass("d-none");
        $(".black-opacity").addClass('add-opacity');

        var friends = document.querySelectorAll('.messages-box .profile-img img');
        friends.forEach((fr) => {
            fr.addEventListener("click", (e) => {
                friend_id = e.target.id;
                friends.forEach((fr) => {
                    (fr.parentNode).parentNode.classList.remove('active');
                });
                (e.target.parentNode).parentNode.classList.add("active");

                setInterval(() => {
                    $.ajax({
                        url: 'getMessages.php',
                        type: 'post',
                        data: { friend_id: friend_id },
                        success: (result) => {
                            $(".messages-box .message-body").html(result);
                        }
                    });
                }, 400)
            });
        });

    });

    $(".addMessages span i").click(() => {
        $.ajax({
            url: "getMessages.php",
            type: "post",
            data: { friend_id: friend_id, msg_text: $(".addMessages .send_msg").val() },
            success: (res) => {
                $(".messages-box .message-body").html(res);
            }
        });
        $(".addMessages .send_msg").val("");
    });



})

