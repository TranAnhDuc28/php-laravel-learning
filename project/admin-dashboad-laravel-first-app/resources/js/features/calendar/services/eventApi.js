import apiClient from "@/common/apiClient.js";

export const fetchEvents = async () => {
    console.log('fetchEvents')
    return await apiClient.get('/apps-calendar/events');
};

export const createEvent = async (eventData) => {
    return await apiClient.post('/events', eventData);
};
