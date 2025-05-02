import {createAsyncThunk, createSlice} from '@reduxjs/toolkit';
import {fetchUsers} from './api.js';

// Thunk để gọi API
export const getUsers = createAsyncThunk('users/getUsers', async (_, { rejectWithValue }) => {
    try {
        return await fetchUsers();
    } catch (error) {
        return rejectWithValue(error.message);
    }
});

// Slice
const usersSlice = createSlice({
    name: 'users',
    initialState: {
        users: [],
        status: 'idle', // 'idle' | 'loading' | 'succeeded' | 'failed'
        error: null,
    },
    reducers: {},
    extraReducers: (builder) => {
        builder
            .addCase(getUsers.pending, (state) => {
                state.status = 'loading';
                state.error = null;
            })
            .addCase(getUsers.fulfilled, (state, action) => {
                state.status = 'succeeded';
                state.users = action.payload;
            })
            .addCase(getUsers.rejected, (state, action) => {
                state.status = 'failed';
                state.error = action.payload;
            });
    },
});

export default usersSlice.reducer;
