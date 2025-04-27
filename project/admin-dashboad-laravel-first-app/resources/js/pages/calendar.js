'use strict';
import {initializeCalendar} from '../modules/calendar/calendar-config.js';
import {setupEventForm} from '../modules/calendar/event-form.js';
import {showModalEventType} from '../modules/calendar/event-modal.js';
import {upcomingEvents} from '../modules/calendar/upcoming-events.js';
import {initializeEventDateTimePickers, clearFlatpickrValues} from '../modules/calendar/date-time-pickers.js';
import {elements} from '../modules/calendar/dom-elements.js';

window.eventList = window.eventList || [];
document.addEventListener('DOMContentLoaded', () => {
    initializeEventDateTimePickers();

    const calendar = initializeCalendar(elements.calendarElement, elements.externalEventElement);
    calendar.render();

    upcomingEvents(window.eventList);

    setupEventForm();

    elements.btnEditEvent.addEventListener('click', (e) => {
        showModalEventType(e.target);
    });

    elements.btnShowModalNewEvent.addEventListener('click', (e) => {
        clearFlatpickrValues();
        initializeEventDateTimePickers();
        elements.btnShowModalNewEvent.setAttribute('data-id', 'new-event');
        elements.btnShowModalNewEvent.click();
        elements.btnShowModalNewEvent.setAttribute('hidden', 'true');
    });
});
