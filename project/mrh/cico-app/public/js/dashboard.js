$(document).ready(function() {
    $('#checkButton').click(function() {
        const checkButton = $('#checkButton');
        checkButton.prop('disabled', true);
        const action = $(this).data('action');
        const checkInUrl = checkButton.data('checkin-url');
        const checkOutUrl = checkButton.data('checkout-url');
        const url = action === 'checkIn' ? checkInUrl : checkOutUrl;
        // const methodType = action === 'checkIn' ? 'POST' : 'PUT'
        console.log(url);
        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status === 'success') {
                    // Update button text and action
                    $('#checkButton').text(
                        response.buttonDisplay === 'checkIn' ? 'Check In' : 'Check Out'
                    ).data('action', response.buttonDisplay);

                    // Show success message
                    alert(response.message);
                    refreshToken();
                    location.reload(true);
                }
                checkButton.prop('disabled', false);
            },
            error: function(xhr) {
                checkButton.prop('disabled', false);
                // Update button text and action
                $('#checkButton').text(
                    xhr.responseJSON.buttonDisplay === 'checkIn' ? 'Check In' : 'Check Out'
                ).data('action', xhr.responseJSON.buttonDisplay);
                alert('Error: ' + xhr.responseJSON.message);
                // refreshToken();
                location.reload(true);
            }
        });
    });
});

function refreshToken() {
    $.get('/refresh-csrf').done(function(data){
        $('meta[name="csrf-token"]').attr('content', data);
        $('input[name="_token"]').val(data);
    });
}
