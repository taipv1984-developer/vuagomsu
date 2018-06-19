function getAppendIntact(url) {
    return (!/\?/.test(url) ? '?' : '&');
}

function simpleCUDModal(dialogId, formId, uuid, actionBtnId, gUrl, pUrl, successCallBack, errorCallBack) {
    $.ajax({
        url: gUrl + getAppendIntact(gUrl) + "rid=" + uuid,
        success: function (res) {
            console.log('res request');
            console.log(res);
            $(dialogId).html(res.content).promise().done(function () {
                $(dialogId).modal();
            });
            $(actionBtnId).click(function () {
                var data = $(formId).serialize();
                $.post(pUrl, data, function (res) {
                    console.log('res response');
                    console.log(res);
                    if (res.errorCode == "SUCCESS") {
                        if (typeof successCallBack != 'undefined' && successCallBack != null) {
                            successCallBack(dialogId, actionBtnId, res);
                        } else {
                            //alert(res.errorMessage);
                            console.log(`simpleCUDModal successCallBack = ${successCallBack} not exist`);
                        }
                    }
                    else if (res.errorCode == "ERROR") {
                        if (typeof errorCallBack != 'undefined' && errorCallBack != null) {
                            errorCallBack(dialogId, actionBtnId, res);
                        } else {
                            //$(formId).replaceWith(res.content);
                            var validateData = res.extra.validateData;
                            //reset validate
                            $('.input').removeClass('validate_error');
                            $('.input').parent().find('.validate_message').html('');
                            for(name in validateData){
                                var message = validateData[name];
                                $('.input[name="' +name+ '"]').addClass('validate_error');
                                $('.input[name="' +name+ '"]').parent().find('.validate_message').html(message);
                            }
                        }
                    }
                }).fail(function () {
                    alert("System error.");
                });
            });
        }
    }).fail(function () {
    });
}

function guid() {
    function s4() {
        return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
    }

    return s4() + s4() + s4() + s4() + s4() + s4() + s4() + s4();
}
