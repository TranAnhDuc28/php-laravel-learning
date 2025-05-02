'use strict';
import {elements} from '../utils/domElementUtils.js';
import {initializeEventDateTimePickers, clearFlatpickrValues} from './InputDateTimePickers.js';
import {formatDateToReadableString, formatDateForPicker, getTimeFromDate, convertTo12HourFormat} from '../utils/dateTimeUtils.js';
import Modal from 'bootstrap/js/dist/modal';
import flatpickr from 'flatpickr';
import Choices from 'choices.js';

const startGroup = elements.inpStartTimePicker.parentNode;
const endGroup = elements.inpEndTimePicker.parentNode;
const eventStartDateGroup = elements.inpEventDatePicker.parentNode;
export const modalInstance = new Modal(elements.modalElement, {keyboard: false});

/**
 * Show new event form or overview based on mode.
 * @param {Object} eventData - FullCalendar event or date click info.
 * @param {string} mode - 'create' or 'overview'.
 */
export const showNewEventForm = (eventData, mode) => {

    let inpEventCategoryChoices = new Choices(elements.inpEventCategory, {searchEnabled: false});

    elements.formEvent.reset();
    elements.btnDeleteEvent.setAttribute('hidden', 'true');
    modalInstance.show();
    elements.formEvent.classList.remove('was-validated');

    if (mode === 'create') {
        elements.modalTitle.innerText = 'Add Event';
        elements.btnEditEvent.setAttribute('data-id', 'new-event');
        elements.btnEditEvent.click();
        elements.btnEditEvent.setAttribute('hidden', 'true');
    } else if (mode === 'overview') {
        const selectedEvent = eventData;
        elements.btnSaveEvent.setAttribute('hidden', 'true');
        elements.btnEditEvent.removeAttribute('hidden');
        elements.btnEditEvent.setAttribute('data-id', 'edit-event');
        elements.btnEditEvent.innerHTML = 'Edit';
        overViewEventClicked();
        initializeEventDateTimePickers();
        clearFlatpickrValues();

        elements.modalTitle.innerHTML = selectedEvent.title;
        elements.inpEventId.value = selectedEvent.id;
        elements.inpEventTitle.value = selectedEvent.title;
        elements.inpEventLocation.value = selectedEvent.extendedProps.location ?? 'No Location';
        elements.inpEventDescription.value = selectedEvent.extendedProps.description ?? 'No Description';
        elements.tagInfoLocationEvent.innerHTML = selectedEvent.extendedProps.location ?? 'No Location';
        elements.tagInfoDescriptionEvent.innerHTML = selectedEvent.extendedProps.description ?? 'No Description';

        if (selectedEvent.classNames[0]) {
            inpEventCategoryChoices.destroy();
            inpEventCategoryChoices = new Choices(elements.inpEventCategory, {searchEnabled: false});
            inpEventCategoryChoices.setChoiceByValue(selectedEvent.classNames[0]);
        }

        const start = selectedEvent.start;
        let end = selectedEvent.end;
        let endFormatted = end ? new Date(end.getTime() - 24 * 60 * 60 * 1000) : null;
        elements.tagInfoEventStartDate.innerHTML = endFormatted
            ? `${formatDateToReadableString(start)} to ${formatDateToReadableString(endFormatted)}`
            : formatDateToReadableString(start);

        const rangeDateFlatpickr = endFormatted
            ? `${formatDateForPicker(start)} to ${formatDateForPicker(endFormatted)}`
            : formatDateForPicker(start);

        flatpickr(elements.inpEventDatePicker, {
            defaultDate: rangeDateFlatpickr,
            altInput: true,
            altFormat: 'j F Y',
            dateFormat: 'Y-m-d',
            mode: 'range',
            onchange: (selectedDates, dateStr) => {
                const isRangeSelected = dateStr.includes(' to ');
                if (isRangeSelected) {
                    elements.eventTimeSection.setAttribute('hidden', 'true');
                } else {
                    elements.eventTimeSection.removeAttribute('hidden');
                    startGroup.classList.remove('d-none');
                    elements.inpStartTimePicker.classList.replace('d-none', 'd-block');
                    endGroup.classList.remove('d-none');
                    elements.inpEndTimePicker.classList.replace('d-none', 'd-block');
                }
            }
        });

        const startTime = getTimeFromDate(selectedEvent.start);
        const endTime = getTimeFromDate(selectedEvent.end);
        const startTimeText = convertTo12HourFormat(startTime);
        const endTimeText = convertTo12HourFormat(endTime);
        const configInpTime = {enableTime: true, noCalendar: true, dateFormat: 'H:i'};

        if (startTime === endTime) {
            elements.eventTimeSection.setAttribute('hidden', 'true');
            flatpickr(elements.inpStartTimePicker, {...configInpTime});
            flatpickr(elements.inpEndTimePicker, {...configInpTime});
        } else {
            elements.eventTimeSection.removeAttribute('hidden');
            flatpickr(elements.inpStartTimePicker, {...configInpTime, defaultDate: startTime});
            flatpickr(elements.inpEndTimePicker, {...configInpTime, defaultDate: endTime});
            elements.tagInfoTimeStartEvent.innerHTML = startTimeText;
            elements.tagInfoTimeEndEvent.innerHTML = endTimeText;
        }

        elements.btnDeleteEvent.removeAttribute('hidden');
    }
};

/**
 * Show form for creating or editing an event.
 */
const showFormCreateOrEditEvent = () => {
    // Delete class 'view-event' khỏi modal form sự kiện
    elements.formEvent.classList.remove('view-event');

    // Show field input category.
    elements.inpEventCategory.classList.replace('d-none', 'd-block');

    // Show field input title.
    elements.inpEventTitle.classList.replace('d-none', 'd-block');
    // Show field input start date.
    eventStartDateGroup.classList.remove('d-none');
    elements.inpEventDatePicker.classList.replace('d-none', 'd-block');
    // Show field input start-end date.
    startGroup.classList.remove('d-none');
    elements.inpStartTimePicker.classList.replace('d-none', 'd-block');
    endGroup.classList.remove('d-none');
    elements.inpEndTimePicker.classList.replace('d-none', 'd-block');
    // Show field input location.
    elements.inpEventLocation.classList.replace('d-none', 'd-block');
    // Show field input description.
    elements.inpEventDescription.classList.replace('d-none', 'd-block');

    // Show button 'Save Event'.
    elements.btnSaveEvent.removeAttribute('hidden');

    // Hide tags info of event.
    elements.tagInfoEventStartDate.classList.replace('d-block', 'd-none');
    elements.tagInfoTimeStartEvent.classList.replace('d-block', 'd-none');
    elements.tagInfoTimeEndEvent.classList.replace('d-block', 'd-none');
    elements.tagInfoLocationEvent.classList.replace('d-block', 'd-none');
    elements.tagInfoDescriptionEvent.classList.replace('d-block', 'd-none');
};

/**
 * Show overview mode for an event.
 */
const overViewEventClicked = () => {
    // Add class 'view-event' vào form sự kiện.
    elements.formEvent.classList.add('view-event');

    // Hide field input category.
    elements.inpEventCategory.classList.replace('d-block', 'd-none');
    // Hide field input title.
    elements.inpEventTitle.classList.replace('d-block', 'd-none');
    // Hide field input start date.
    eventStartDateGroup.classList.add('d-none');
    elements.inpEventDatePicker.classList.replace('d-block', 'd-none');
    // Hide field input start-end date.
    elements.eventTimeSection.setAttribute('hidden', 'true');
    startGroup.classList.add('d-none');
    elements.inpStartTimePicker.classList.replace('d-block', 'd-none');
    endGroup.classList.add('d-none');
    elements.inpEndTimePicker.classList.replace('d-block', 'd-none');
    // Hide field input location.
    elements.inpEventLocation.classList.replace('d-block', 'd-none');
    // Hide field input description.
    elements.inpEventDescription.classList.replace('d-block', 'd-none');
    // Hide button 'Save Event'.
    elements.btnSaveEvent.setAttribute('hidden', 'true');

    // Show tags info of event.
    elements.tagInfoEventStartDate.classList.replace('d-none', 'd-block');
    elements.tagInfoTimeStartEvent.classList.replace('d-none', 'd-block');
    elements.tagInfoTimeEndEvent.classList.replace('d-none', 'd-block');
    elements.tagInfoLocationEvent.classList.replace('d-none', 'd-block');
    elements.tagInfoDescriptionEvent.classList.replace('d-none', 'd-block');
};

/**
 * Show modal for create or edit event.
 * @param {HTMLElement} el - The button element.
 */
export const showModalEventType = (el) => {
    const eventType = el.getAttribute('data-id');

    if (eventType === 'new-event') {
        elements.modalTitle.innerHTML = 'Add Event';
        elements.btnSaveEvent.innerHTML = 'Add Event';
        showFormCreateOrEditEvent();
    } else if (eventType === 'edit-event') {
        el.innerHTML = 'Cancel';
        el.setAttribute('data-id', 'cancel-event');
        elements.btnSaveEvent.innerHTML = 'Update Event';
        showFormCreateOrEditEvent();
    } else {
        el.innerHTML = 'Edit';
        el.setAttribute('data-id', 'edit-event');
        overViewEventClicked();
    }
};
//
// /**
//  *
//  * @param event
//  */
// const showNewEventForm = (event) => {
//     elements.formEvent.reset();
//     elements.btnDeleteEvent.setAttribute('hidden', 'true');
//     modalInstance.show();
//     elements.formEvent.classList.remove('was-validated');
//     selectedEvent = null;
//     elements.modalTitle.innerText = 'Add Event';
//     newEventData = event;
//     elements.btnEditEvent.setAttribute('data-id', 'new-event');
//     elements.btnEditEvent.click();
//     elements.btnEditEvent.setAttribute('hidden', 'true');
// }
