$(document).on('pageinit', '#loginPage', function(){
        $(document).on('click', '#submitButton', function() { // catch the form's submit event
            if($('#username').val().length > 0 && $('#password').val().length > 0){
                // Send data to server through the ajax call
                // action is functionality we want to call and outputJSON is our data
                    $.ajax({url: 'http://www.europicker.it/app/auth.php',
                        data: {action : 'loginPage', formData : $('#loginForm').serialize()},
                        type: 'post',                
                        async: 'true',
                        dataType: "json",
                        beforeSend: function() {
                            // This callback function will trigger before data is sent
                           $.mobile.loading('show') // This will show ajax spinner
                        },
                        complete: function() {
                            // This callback function will trigger on data sent/received complete
                            $.mobile.loading('hide')// This will hide ajax spinner
                        },
                        success: function (result) {
                            if(result.status == 1) {
                                 window.location.href = 'main.html';                        
                            } else {
                                navigator.notification.alert('Something went wrong...',null,'Error','Done');
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                        alert("error: " + jqXHR.responseText);
                    }
                    });                  
            } else {
                alert('Please fill all necessary fields');
            }          
            return false; // cancel original event to prevent form submitting
        });   
});