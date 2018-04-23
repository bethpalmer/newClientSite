$(function () {
    // init the validator
    // validator files are included in the download package
    // otherwise download from http://1000hz.github.io/bootstrap-validator
    $('#form-web-design').validator();
    $('#form-graphic-design').validator();
    $('#form-web-support').validator();
    // when the form is submitted
    $('#form-web-design').on('submit', function (e) {
        // if the validator does not prevent form submit
        if (!e.isDefaultPrevented()) {
            var url = "contact-web-design.php";
            // POST values in the background the the script URL
            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: function (data) {
                    // data = JSON object that contact.php returns
                    // we recieve the type of the message: success x danger and apply it to the 
                    var messageAlert = 'alert-' + data.type;
                    var messageText = data.message;
                    // let's compose Bootstrap alert box HTML
                    var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                    // If we have messageAlert and messageText
                    if (messageAlert && messageText) {
                        // inject the alert to .messages div in our form
                        $('#form-web-design').find('.messages').html(alertBox);
                        // empty the form
                        $('#form-web-design')[0].reset();
                    }
                }
            });
            return false;
        }
    });
    $('#form-graphic-design').on('submit', function (e) {
        // if the validator does not prevent form submit
        if (!e.isDefaultPrevented()) {
            var url = "contact-graphic.php";
            // POST values in the background the the script URL
            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: function (data) {
                    // data = JSON object that contact.php returns
                    // we recieve the type of the message: success x danger and apply it to the 
                    var messageAlert = 'alert-' + data.type;
                    var messageText = data.message;
                    // let's compose Bootstrap alert box HTML
                    var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                    // If we have messageAlert and messageText
                    if (messageAlert && messageText) {
                        // inject the alert to .messages div in our form
                        $('#form-graphic-design').find('.messages').html(alertBox);
                        // empty the form
                        $('#form-graphic-design')[0].reset();
                    }
                }
            });
            return false;
        }
    });
    $('#form-web-support').on('submit', function (e) {
        // if the validator does not prevent form submit
        if (!e.isDefaultPrevented()) {
            var url = "contact-web-support.php";
            // POST values in the background the the script URL
            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: function (data) {
                    // data = JSON object that contact.php returns
                    // we recieve the type of the message: success x danger and apply it to the 
                    var messageAlert = 'alert-' + data.type;
                    var messageText = data.message;
                    // let's compose Bootstrap alert box HTML
                    var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                    // If we have messageAlert and messageText
                    if (messageAlert && messageText) {
                        // inject the alert to .messages div in our form
                        $('#form-web-support').find('.messages').html(alertBox);
                        // empty the form
                        $('#form-web-support')[0].reset();
                    }
                }
            });
            return false;
        }
    });
});