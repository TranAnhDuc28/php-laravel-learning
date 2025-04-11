document.addEventListener('DOMContentLoaded', function() {
    const startHour = document.getElementById('start_time_hour');
    const startMinute = document.getElementById('start_time_minute');
    const endHour = document.getElementById('end_time_hour');
    const endMinute = document.getElementById('end_time_minute');
    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');

    function validateTimes() {
        const start = parseInt(startHour.value) * 60 + parseInt(startMinute.value);
        const end = parseInt(endHour.value) * 60 + parseInt(endMinute.value);

        if (end <= start && startDate.value === endDate.value) {
            endHour.value = parseInt(startHour.value) + 2 > 17 ? 17 : parseInt(startHour.value) + 2;
            endMinute.value = startMinute.value;
        }
    }

    function validateDate() {
        const start = new Date(startDate.value);
        const end = new Date(endDate.value);

        if (end < start) {
            endDate.value = startDate.value;
            startHour.value = "08";
            endHour.value = "17";
            endMinute.value = startMinute.value = "00";
        }
    }

    startHour.addEventListener('change', validateTimes);
    startMinute.addEventListener('change', validateTimes);
    endHour.addEventListener('change', validateTimes);
    endMinute.addEventListener('change', validateTimes);
    startDate.addEventListener('change', validateDate);
    endDate.addEventListener('change', validateDate);
});

$(document).ready(function() {
    $('#leaveForm').on('submit', function() {
        $(this).find('button[type="submit"]').prop('disabled', true);
        return true;
    });
});

$(document).ready(function() {
    // Cache DOM elements
    const $leaveType = $('#leave_type');
    const $startDate = $('input[name="start_date"]');
    const $endDate = $('input[name="end_date"]');
    const $startHour = $('#start_time_hour');
    const $startMinute = $('#start_time_minute');
    const $endHour = $('#end_time_hour');
    const $endMinute = $('#end_time_minute');

    // Time options
    const timeOptions = {
        paidLeaveHoursSameDay: ['08', '10', '13', '15'],
        paidLeaveHoursEndSameDay: ['10', '12', '15', '17'],
        unpaidLeaveHours: Array.from({length: 9}, (_, i) => String(i + 8).padStart(2, '0')), // 08 to 16
        unpaidLeaveEndHours: Array.from({length: 10}, (_, i) => String(i + 8).padStart(2, '0')), // 08 to 17
        defaultMinutes: ['00'],
        // unpaidLeaveMinutes: ['00', '15', '30', '45'],
        // unpaidLeaveMinutes: ['00', '30'],
        unpaidLeaveMinutes: ['00'],
    };

    // Function to check if dates are equal
    function areDatesEqual() {
        return $startDate.val() === $endDate.val();
    }

    // Function to update time options
    function updateTimeOptions() {
        const leaveType = $leaveType.val();
        const sameDay = areDatesEqual();

        // Clear existing options
        $startHour.empty();
        $endHour.empty();
        $startMinute.empty();
        $endMinute.empty();

        if (leaveType === '1' || leaveType === '3') {
            if (sameDay) {
                // Populate hours for same day
                timeOptions.paidLeaveHoursSameDay.forEach(hour => {
                    $startHour.append(`<option value="${hour}">${hour}</option>`);
                });
                timeOptions.paidLeaveHoursEndSameDay.forEach(hour => {
                    $endHour.append(`<option value="${hour}">${hour}</option>`);
                });
            } else {
                // Different days - fixed hours
                $startHour.append('<option value="08">08</option>');
                $endHour.append('<option value="17">17</option>');
            }
            // Only 00 for minutes
            $startMinute.append('<option value="00">00</option>');
            $endMinute.append('<option value="00">00</option>');
        }
        else if (leaveType === '2') {
            if (sameDay) {
                // Populate flexible hours and minutes for unpaid leave
                timeOptions.unpaidLeaveHours.forEach(hour => {
                    $startHour.append(`<option value="${hour}">${hour}</option>`);
                });
                timeOptions.unpaidLeaveEndHours.forEach(hour => {
                    $endHour.append(`<option value="${hour}">${hour}</option>`);
                });
                // Flexible minutes
                timeOptions.unpaidLeaveMinutes.forEach(minute => {
                    $startMinute.append(`<option value="${minute}">${minute}</option>`);
                    $endMinute.append(`<option value="${minute}">${minute}</option>`);
                });
            } else {
                // Different days - fixed hours
                $startHour.append('<option value="08">08</option>');
                $endHour.append('<option value="17">17</option>');
                // Only 00 for minutes
                $startMinute.append('<option value="00">00</option>');
                $endMinute.append('<option value="00">00</option>');
            }
        }
        else {
            // Different days - fixed hours
            $startHour.append('<option value="08">08</option>');
            $endHour.append('<option value="17">17</option>');
            // Only 00 for minutes
            $startMinute.append('<option value="00">00</option>');
            $endMinute.append('<option value="00">00</option>');
        }

        // Validate end time is after start time for same day
        if (sameDay) {
            $startHour.on('change', function() {
                const startHour = parseInt($(this).val());
                $endHour.find('option').each(function() {
                    const endHour = parseInt($(this).val());
                    $(this).prop('disabled', endHour <= startHour);
                });
                // Reset end hour if invalid
                if (parseInt($endHour.val()) <= startHour) {
                    $endHour.val($endHour.find('option:not(:disabled)').first().val());
                }
            });
        }
    }

    // Event listeners
    $leaveType.on('change', updateTimeOptions);
    $startDate.on('change', updateTimeOptions);
    $endDate.on('change', updateTimeOptions);

    // Initial update
    updateTimeOptions();
});
// function formatDate(input) {
//     alert(input);
//     const date = new Date(input.value);
//     const year = date.getFullYear();
//     const month = String(date.getMonth() + 1).padStart(2, '0');
//     const day = String(date.getDate()).padStart(2, '0');
//     input.value = `${year}/${month}/${day}`;
// }
//
// // Format initial values
// document.addEventListener('DOMContentLoaded', function() {
//     formatDate(document.getElementById('start_date'));
//     formatDate(document.getElementById('end_date'));
// });
