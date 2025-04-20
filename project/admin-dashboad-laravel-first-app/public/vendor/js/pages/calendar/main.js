'use strict';
import { initializeCalendar } from './modules/calendar-config.js';
import { setupEventForm } from './modules/event-form.js';
import { showModalEventType } from './modules/event-modal.js';
import { upcomingEvents } from './modules/upcoming-events.js';
import { initializeEventDateTimePickers } from './modules/date-time-pickers.js';
import { elements } from './modules/dom-elements.js';

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

    elements.btnSaveEvent.addEventListener('click', () => {
        showModalEventType(elements.btnEditEvent);
    });
});
