'use strict';
import {initializeCalendar} from '../features/calendar/component/CalendarComponent.js';
import {setupEventForm} from '../features/calendar/component/EventForm.js';
import {showModalEventType} from '../features/calendar/component/EventModal.js';
import {upcomingEventsComponent} from '../features/calendar/component/UpcomingEventsComponent.js';
import {initializeEventDateTimePickers, clearFlatpickrValues} from '../features/calendar/component/InputDateTimePickers.js';
import {elements} from '../features/calendar/utils/domElementUtils.js';
import {store} from "@/store.js";
import {getEvents} from "@/features/calendar/slice/eventsSlice.js";
import BootstrapToastWrapper from "@/common/components/BootstrapToastWrapper.js";
import ToastifyWrapper from "@/common/components/ToastifyWrapper.js";

document.addEventListener('DOMContentLoaded', async () => {
    /* Render UI. */
    const calendar = initializeCalendar(elements.calendarElement, elements.externalEventElement);
    calendar.render();

    initializeEventDateTimePickers();

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

    /**
     * Render data events and handle UI updates based on Redux state.
     */
    const renderDataEvents = () => {
        console.log('Render data.');
        const state = store.getState().events;
        if (state.status === 'succeeded') {
            ToastifyWrapper.success('Events loaded successfully!');
            BootstrapToastWrapper.success('Events loaded successfully!');

            /* Calendar event list */
            calendar.refetchEvents();

            /* Upcoming event list. */
            upcomingEventsComponent();
        } else if (state.status === 'failed' && state.error) {
            ToastifyWrapper.error(state.error);
            BootstrapToastWrapper.error(state.error);
        }
    };

    /* Call api. */
    store.dispatch(getEvents());
    store.subscribe(renderDataEvents);
});
