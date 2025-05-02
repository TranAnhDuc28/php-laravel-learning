'use strict';

import { upcomingEventsComponent } from './UpcomingEventsComponent.js';
import {elements} from "../utils/domElementUtils.js";
import {initializeCalendar as calendar} from './CalendarComponent.js'
import {modalInstance} from "./EventModal.js";

/**
 * Setup event listeners for form submission, delete, and save buttons.
 */
export const setupEventForm = () => {
    let selectedEvent = null;

    // Handle form submit
    elements.formEvent.addEventListener('submit', (e) => {
        e.preventDefault();

        const eventTitle = elements.inpEventTitle.value;
        const eventCategory = elements.inpEventCategory.value;
        const dateRange = elements.inpEventDatePicker.value.split(' to ');
        const eventLocation = elements.inpEventLocation.value;
        const eventDescription = elements.inpEventDescription.value;
        const eventId = elements.inpEventId.value;
        let isAllDay = false;
        let nextId = window.eventList.length + 1;

        let startDate, endDate;
        if (dateRange.length > 1) {
            startDate = new Date(dateRange[0].trim());
            endDate = new Date(dateRange[1].trim());
            endDate.setDate(endDate.getDate() + 1);
            isAllDay = true;
        } else {
            const dateStr = dateRange[0].trim();
            const startTime = elements.inpStartTimePicker.value.trim();
            const endTime = elements.inpEndTimePicker.value.trim();
            startDate = new Date(`${dateStr}T${startTime}`);
            endDate = new Date(`${dateStr}T${endTime}`);
        }

        if (elements.formEvent.checkValidity() === false) {
            elements.formEvent.classList.add('was-validated');
            return;
        }

        if (selectedEvent) {
            selectedEvent.setProp('id', eventId);
            selectedEvent.setProp('title', eventTitle);
            selectedEvent.setProp('classNames', [eventCategory]);
            selectedEvent.setStart(startDate);
            selectedEvent.setEnd(endDate);
            selectedEvent.setAllDay(isAllDay);
            selectedEvent.setExtendedProp('description', eventDescription);
            selectedEvent.setExtendedProp('location', eventLocation);

            const eventIndex = window.eventList.findIndex(event => event.id === selectedEvent.id);
            if (window.eventList[eventIndex]) {
                window.eventList[eventIndex].title = eventTitle;
                window.eventList[eventIndex].start = startDate;
                window.eventList[eventIndex].end = endDate;
                window.eventList[eventIndex].allDay = isAllDay;
                window.eventList[eventIndex].className = eventCategory;
                window.eventList[eventIndex].description = eventDescription;
                window.eventList[eventIndex].location = eventLocation;
            }
            calendar.render();
        } else {
            const newEvent = {
                id: nextId,
                title: eventTitle,
                start: startDate,
                end: endDate,
                allDay: isAllDay,
                className: eventCategory,
                description: eventDescription,
                location: eventLocation
            };
            calendar.addEvent(newEvent);
            window.eventList.push(newEvent);
        }

        modalInstance.hide();
        upcomingEventsComponent(window.eventList);
    });

    // Handle delete event.
    elements.btnDeleteEvent.addEventListener('click', () => {
        if (selectedEvent) {
            window.eventList = window.eventList.filter(event => event.id !== selectedEvent.id);
            selectedEvent.remove();
            selectedEvent = null;
            modalInstance.hide();
            upcomingEventsComponent(window.eventList);
        }
    });

    // Handle save event.
    elements.btnSaveEvent.addEventListener('click', () => {
        selectedEvent = null;
        elements.formEvent.reset();
        elements.formEvent.classList.remove('was-validated');
    });
};
