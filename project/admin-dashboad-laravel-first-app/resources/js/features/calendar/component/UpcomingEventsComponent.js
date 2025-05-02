'use strict';

import {getTimeFromDate, convertTo12HourFormat, formatDateToLocaleDateString} from '../utils/dateTimeUtils.js';
import {store} from "@/store.js";

/**
 * Update upcoming events list.
 */
export const upcomingEventsComponent = () => {
    const upcomingList = document.getElementById('upcoming-event-list');
    upcomingList.innerHTML = '';

    const state = store.getState().events;
    const events = state.events.items;
    if (!events || !Array.isArray(events) || events.length === 0) return;

    const sortedEvents = [...events].sort((a, b) => new Date(a.start) - new Date(b.start));

    sortedEvents.forEach((event) => {
        const title = event.title || '';
        const description = event.description || '';
        const startDate = new Date(event.start);
        const endDate = event.end ? new Date(event.end) : null;

        // Format start date.
        const formattedStartDate = formatDateToLocaleDateString(startDate);

        // Giảm 1 ngày nếu có endDate (do fullCalendar ghi nhận ngày kết thúc không bao gồm).
        let formattedEndDate = null;
        if (endDate) {
            endDate.setDate(endDate.getDate() - 1);
            formattedEndDate = formatDateToLocaleDateString(endDate);
        }
        formattedEndDate = (endDate && (formattedEndDate !== formattedStartDate)) ? ' to ' + formattedEndDate : '';

        // Format times.
        let startTime = convertTo12HourFormat(getTimeFromDate(startDate));
        let endTime = endDate ? convertTo12HourFormat(getTimeFromDate(endDate)) : null;
        if (startTime === endTime) {
            startTime = 'Full day event';
            endTime = null;
        }

        const timeRange = endTime ? ` to ${endTime}` : '';
        const colorClass = event.classNames?.split('-')[1] || 'primary';

        const cardUpcomingEventItem = `
        <div class='card mb-3'>
            <div class='card-body'>
                <div class='d-flex mb-3'>
                    <div class='flex-grow-1'>
                        <i class='mdi mdi-checkbox-blank-circle me-2 text-${colorClass}'></i>
                        <span class='fw-medium'>${formattedStartDate}${formattedEndDate}</span>
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
