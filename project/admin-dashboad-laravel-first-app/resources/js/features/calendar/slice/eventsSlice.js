import {createAsyncThunk, createSlice} from '@reduxjs/toolkit';
import {createEvent, fetchEvents} from "@/features/calendar/services/eventApi.js";

const initialState = {
    isLoading: false,
    events: [],
    status: 'idle',
    error: null,
}

export const getEvents = createAsyncThunk('events/getEvents', async (_, {rejectWithValue}) => {
    console.log('getEvents')
    try {
        return await fetchEvents();
    } catch (error) {
        return rejectWithValue(error.message);
    }
});

export const addEvent = createAsyncThunk('events/addEvent', async (eventData, {rejectWithValue}) => {
    try {
        return await createEvent(eventData);
    } catch (error) {
        return rejectWithValue(error.message);
    }
});

const eventsSlice = createSlice({
    name: 'events',
    initialState,
    extraReducers:
        (builder) => {
            builder
                .addCase(getEvents.pending, (state) => {
                    console.log('Call events pending.')
                    state.isLoading = true;
                    state.status = 'loading';
                    state.error = null;
                })
                .addCase(getEvents.fulfilled, (state, action) => {
                    console.log('Call events succeeded.', action.payload);
                    state.isLoading = false;
                    state.status = 'succeeded';
                    state.events = action.payload;
                })
                .addCase(getEvents.rejected, (state, action) => {
                    console.log('Call events failed.', action.payload);
                    state.isLoading = false;
                    state.status = 'failed';
                    state.error = action.payload;
                })
                .addCase(addEvent.fulfilled, (state, action) => {
                    state.events.push(action.payload);
                });
        },
});

export default eventsSlice.reducer;
