import { configureStore } from '@reduxjs/toolkit';
import eventsReducer from './features/calendar/slice/eventsSlice';

export const store = configureStore({
    reducer: {
        events: eventsReducer,
    },
});
