'use strict';
import {elements} from './dom-elements.js';
import el from "../../../../../assets/libs/moment/src/locale/el.js";

/**
 * Initialize flatpickr for date and time pickers.
 */
export const initializeEventDateTimePickers = () => {
    const timeOnlyOptions = {
        enableTime: true,
        noCalendar: true
    };

    flatpickr(elements.inpEventDatePicker, {
        enableTime: false,
        mode: 'range',
        minDate: 'today',
        onchange: (selectedDates, dateStr) => {
            const isRangeSelected = dateStr.includes('to');
            const startGroup = elements.inpStartTimePicker.parentNode;
            const endGroup = elements.inpEndTimePicker.parentNode;

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

    flatpickr(elements.inpStartTimePicker, timeOnlyOptions);
    flatpickr(elements.inpEndTimePicker, timeOnlyOptions);
};

/**
 * Clear values of flatpickr instances.
 */
export const clearFlatpickrValues = () => {
    elements.inpEventDatePicker.flatpickr().clear();
    elements.inpStartTimePicker.flatpickr().clear();
    elements.inpEndTimePicker.flatpickr().clear();
};
