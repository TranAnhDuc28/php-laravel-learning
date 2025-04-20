'use strict';

/**
 * Get time from a Date object.
 * @param {Date} date - The Date object.
 * @returns {string|null} - Time in "HH:mm" format or null if invalid.
 */
export const getTimeFromDate = (date) => {
    if (!date) return null;
    const d = new Date(date);
    const hours = d.getHours();
    const minutes = d.getMinutes();
    if (isNaN(hours)) return null;
    return `${hours}:${minutes.toString().padStart(2, '0')}`;
};

/**
 * Convert 24-hour time to 12-hour format with AM/PM.
 * @param {string} timeStr - Time in "HH:mm" format.
 * @returns {string} - Time in "HH:mm AM/PM" format.
 */
export const convertTo12HourFormat = (timeStr) => {
    if (!timeStr) return '';
    try {
        const [hours, minutes] = timeStr.split(':');
        let hour = parseInt(hours);
        const minute = parseInt(minutes);
        const suffix = hour >= 12 ? 'PM' : 'AM';
        const hour12 = hour % 12 || 12;
        return `${hour12}:${minute.toString().padStart(2, '0')} ${suffix}`;
    } catch (error) {
        console.error('Invalid time format:', timeStr);
        return '';
    }
};

/**
 * Format date to readable string (DD Month, YYYY).
 * @param {string|Date} input - Date string or Date object.
 * @returns {string} - Formatted date string.
 */
export const formatDateToReadableString = (input) => {
    const date = new Date(input);
    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    const day = String(date.getDate()).padStart(2, '0');
    const month = monthNames[date.getMonth()];
    const year = date.getFullYear();
    return `${day} ${month}, ${year}`;
};

/**
 * Format date for date picker (YYYY-MM-DD).
 * @param {Date} dateStr - Date object.
 * @returns {string|null} - Formatted date string or null if invalid.
 */
export const formatDateForPicker = (dateStr) => {
    if (!dateStr) return null;
    const date = new Date(dateStr);
    const month = `${date.getMonth() + 1}`.padStart(2, '0');
    const day = `${date.getDate()}`.padStart(2, '0');
    return `${date.getFullYear()}-${month}-${day}`;
};

/**
 * Format date to locale-specific string.
 * @param {Date} date - Date object.
 * @param {string} locales - Locale code (e.g., 'en-GB').
 * @param {string} format - Format key (e.g., 'short').
 * @returns {string|null} - Formatted date string or null if invalid.
 */
export const formatDateToLocaleDateString = (date, locales = 'en-GB', format = 'short') => {
    if (!date) return null;
    const formatOptions = DATE_FORMATS[format] || DATE_FORMATS.short;
    return date.toLocaleDateString(locales, formatOptions);
};

const DATE_FORMATS = {
    numeric: { day: 'numeric', month: 'numeric', year: 'numeric' },
    short: { day: 'numeric', month: 'short', year: 'numeric' },
    long: { day: 'numeric', month: 'long', year: 'numeric' },
    compact: { day: '2-digit', month: '2-digit', year: 'numeric' },
    shortYear: { day: 'numeric', month: 'short', year: '2-digit' },
    monthFirst: { month: 'short', day: 'numeric', year: 'numeric' },
    yearFirst: { year: 'numeric', month: 'short', day: 'numeric' }
};
