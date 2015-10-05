$(document).ready(function () {
    $('form').submit(function () {
        $.post('/index.php', $(this).serialize(), function (r) {
            if (r == 'success') {
                history.go(0);
            } else if (r == 'locked') {
                $('form').html('<h2>Log in are currently blocked.</h2>');
            } else {
                $('input[type=password]').addClass('error');
            }
        });
        return false;
    });
});