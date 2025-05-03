'use strict';
import {Calendar} from '@fullcalendar/core';
import interactionPlugin, {Draggable} from '@fullcalendar/interaction';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid'
import listPlugin from '@fullcalendar/list';
import {upcomingEventsComponent} from './UpcomingEventsComponent.js';
import {showNewEventForm} from './EventModal.js';
import {store} from "@/store.js";

/**
 * Determines the FullCalendar view mode based on the current screen width.
 * @returns {string}
 */
const getCalendarViewByScreenWidth = () => {
    const screenWidth = window.innerWidth;
    if (screenWidth <= 768) {
        return 'listMonth';
    } else if (screenWidth < 1200) {
        return 'timeGridWeek';
    } else {
        return 'dayGridMonth';
    }
};


/**
 * Initialize FullCalendar with provided configuration.
 * @param {HTMLElement} calendarElement - The calendar DOM element.
 * @param {HTMLElement} externalEventElement - The external events DOM element.
 * @returns {Calendar} - The initialized calendar instance.
 */
export const initializeCalendar = (calendarElement, externalEventElement) => {
    // Create a Draggable object for external events
    new Draggable(externalEventElement, {
        itemSelector: `.external-event`,
        eventData: (eventEl) => ({
            id: Math.floor(10000 * Math.random()),
            title: eventEl.innerText,
            allDay: true,
            start: new Date(),
            className: eventEl.getAttribute('data-class')
        })
    });

    // Initialize FullCalendar
    const calendar = new Calendar(calendarElement, {
        plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin, listPlugin],
        timeZone: 'local',
        editable: true,
        droppable: true,
        selectable: true,
        navLinks: true,
        initialView: getCalendarViewByScreenWidth(),
        themeSystem: 'bootstrap5',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        loading: (isLoading) => {
            const state = store.getState().events
            return isLoading === state.isLoading;
        },
        events: (info, successCallback, failureCallback) => {
            const state = store.getState().events;
            const events = state.events.items;
            if (!events || !Array.isArray(events) || events.length === 0) {
                console.log('Render UI Calendar.');
                successCallback([]);
                return;
            }

            if (state.status === 'succeeded') {
                console.log('Render data calendar', state.events);
                successCallback(events);
            } else if (state.status === 'failed') {
                failureCallback(new Error(state.error));
            } else {
                successCallback([]);
            }
        },
        windowResize: () => {
            const calendarView = getCalendarViewByScreenWidth();
            calendar.changeView(calendarView);
        },
        eventResize: (eventResizeInfo) => {
            const updatedEvent = eventResizeInfo.event;
            const eventIndex = window.eventList.findIndex(event => event.id === updatedEvent.id);
            if (eventIndex !== -1 && window.eventList[eventIndex]) {
                const existingEvent = window.eventList[eventIndex];
                existingEvent.title = updatedEvent.title;
                existingEvent.start = updatedEvent.start;
                existingEvent.end = updatedEvent.end || null;
                existingEvent.allDay = updatedEvent.allDay;
                existingEvent.className = updatedEvent.classNames[0];
                existingEvent.location = updatedEvent._def.extendedProps.location || '';
                existingEvent.description = updatedEvent._def.extendedProps.description || '';
            }
            upcomingEventsComponent(window.eventList);
        },
        eventClick: (info) => {
            info.jsEvent.preventDefault();
            showNewEventForm(info, 'edit');
        },
        dateClick: (info) => {
            showNewEventForm(info, 'create');
        },
        eventReceive: (info) => {
            const newEvent = {
                id: parseInt(info.event.id),
                title: info.event.title,
                start: info.event.start,
                allDay: info.event.allDay,
                className: info.event.classNames[0]
            };
            window.eventList.push(newEvent);
            upcomingEventsComponent(window.eventList);
        },
        eventDrop: (info) => {
            const updatedEvent = info.event;
            const eventIndex = window.eventList.findIndex(event => event.id === info.event.id);
            if (eventIndex !== -1 && window.eventList[eventIndex]) {
                const existingEvent = window.eventList[eventIndex];
                existingEvent.title = updatedEvent.title;
                existingEvent.start = updatedEvent.start;
                existingEvent.end = updatedEvent.end || null;
                existingEvent.allDay = updatedEvent.allDay;
                existingEvent.className = updatedEvent.classNames[0];
                existingEvent.location = updatedEvent._def.extendedProps.location || '';
                existingEvent.description = updatedEvent._def.extendedProps.description || '';
                upcomingEventsComponent(window.eventList);
            }
        }
    });

    return calendar;
};
