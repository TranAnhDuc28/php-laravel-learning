'use strict';

import { formatDateToReadableString, getTimeFromDate, convertTo12HourFormat, formatDateToLocaleDateString } from './date-time-utils.js';

/**
 * Update upcoming events list.
 * @param {Array} events - List of events.
 */
export const upcomingEvents = (events) => {
    eventList.sort((a, b) => new Date(a.start) - new Date(b.start));
    const upcomingList = document.getElementById('upcoming-event-list');
    upcomingList.innerHTML = '';

    events.forEach((event) => {
        const title = event.title || '';
        const description = event.description || '';
        const startDate = new Date(event.start);
        const endDate = event.end ? new Date(event.end) : null;

        const formattedStartDate = formatDateToLocaleDateString(startDate);
        let formattedEndDate = null;
        if (endDate) {
            endDate.setDate(endDate.getDate() - 1);
            formattedEndDate = formatDateToLocaleDateString(endDate);
        }

        const startDateFormatted = formatDateToReadableString(formattedStartDate);
        const endDateFormatted = (endDate && (formatDateToReadableString(formattedEndDate) !== startDateFormatted))
            ? ' to ' + formatDateToReadableString(formattedEndDate)
            : '';

        let startTime = convertTo12HourFormat(getTimeFromDate(startDate));
        let endTime = endDate ? convertTo12HourFormat(getTimeFromDate(endDate)) : null;

        if (startTime === endTime) {
            startTime = 'Full day event';
            endTime = null;
        }

        const timeRange = endTime ? ` to ${endTime}` : '';
        const colorClass = event.className?.split('-')[1] || 'primary';

        const cardUpcomingEventItem = `
        <div class='card mb-3'>
            <div class='card-body'>
                <div class='d-flex mb-3'>
                    <div class='flex-grow-1'>
                        <i class='mdi mdi-checkbox-blank-circle me-2 text-${colorClass}'></i>
                        <span class='fw-medium'>${startDateFormatted}${endDateFormatted}</span>
                    </div>
                    <div class='flex-shrink-0'>
                        <small class='badge bg-primary-subtle text-primary ms-auto'>
                            ${startTime}${timeRange}
                        </small>
                    </div>
                </div>
                <h6 class='card-title fs-16'>${title}</h6>
                <p class='text-muted text-truncate-two-lines mb-0'>${description}</p>
            </div>
        </div>`;

        upcomingList.innerHTML += cardUpcomingEventItem;
    });
};
