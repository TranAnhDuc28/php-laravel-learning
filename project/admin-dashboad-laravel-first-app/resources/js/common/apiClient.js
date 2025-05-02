const BASE_URL = import.meta.env.VITE_API_URL || 'http://localhost:8000/api'; // Base URL.

const configHeaders = {
    'Content-Type': 'application/json',
}

const apiClient = {
    get: async (endpoint, options = {}) => {
        try {
            const response = await fetch(`${BASE_URL}${endpoint}`, {
                method: 'GET',
                headers: {
                    ...configHeaders,
                    ...options.headers,
                },
                ...options,
            });
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            throw new Error(`Failed to fetch: ${error.message}`);
        }
    },
    post: async (endpoint, data, options = {}) => {
        try {
            const response = await fetch(`${BASE_URL}${endpoint}`, {
                method: 'POST',
                headers: {
                    ...configHeaders,
                    ...options.headers,
                },
                body: JSON.stringify(data),
                ...options,
            });
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            throw new Error(`Failed to post: ${error.message}`);
        }
    },
};

export default apiClient;
