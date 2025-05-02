import { store } from './store.js';
import { getUsers } from './usersSlice.js';

// Lấy các phần tử DOM
const fetchButton = document.getElementById('fetchUsers');
const usersList = document.getElementById('usersList');
const statusDiv = document.getElementById('status');

// Hàm cập nhật giao diện
const render = () => {
    const state = store.getState().users;
    // Cập nhật trạng thái
    statusDiv.textContent = state.status === 'loading' ? 'Loading...' :
        state.status === 'failed' ? `Error: ${state.error}` : '';
    // Cập nhật danh sách users
    usersList.innerHTML = '';
    if (state.status === 'succeeded') {
        state.users.forEach(user => {
            const li = document.createElement('li');
            li.textContent = `${user.name} (${user.email})`;
            usersList.appendChild(li);
        });
    }
};

// Subscribe để tự động cập nhật khi state thay đổi
store.subscribe(render);

// Xử lý sự kiện click nút
fetchButton.addEventListener('click', () => {
    store.dispatch(getUsers());
});
