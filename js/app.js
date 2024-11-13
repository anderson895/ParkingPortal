$("#frmLogin").submit(function (e) {
    e.preventDefault();
    

    $('#spinner').show();
    $('#btnLogin').prop('disabled', true);
    
    var formData = $(this).serializeArray(); 
    formData.push({ name: 'requestType', value: 'Login' });
    var serializedData = $.param(formData);

    // Perform the AJAX request
    $.ajax({
      type: "POST",
      url: "backend/endpoints/controller.php",
      data: serializedData,
      dataType: 'json',
      success: function (response) {

        console.log(response)

        if (response.status === "success") {
          alertify.success('Login Successful');

          setTimeout(function () {
            window.location.href = "admin/dashboard.php"; 
          }, 1000);

        } else {
          $('#spinner').hide();
          $('#btnLogin').prop('disabled', false);
          console.log(response); 
          alertify.error(response.message);
        }
      },
      error: function () {
        $('#spinner').hide();
        $('#btnLogin').prop('disabled', false);
        alertify.error('An error occurred. Please try again.');
      }
    });
  });