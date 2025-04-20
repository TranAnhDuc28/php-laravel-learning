// Get CSRF token from meta tag
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
const loadingElement = document.getElementById('calendar-loading');

// Function to show/hide loading state
function toggleLoading(show) {
    loadingElement.classList.toggle('d-none', !show);
}

// Function to get route URL with parameters
function getRouteUrl(route, params = {}) {
    let url = route;
    for (const [key, value] of Object.entries(params)) {
        url = url.replace(`:${key}`, value);
    }
    return url;
}

// Function to update existing event
function updateExistingEvent(event, data) {
    event.setProp('title', data.title);
    event.setStart(data.start);
    event.setEnd(data.end);
    event.setProp('allDay', data.allDay);
    event.setProp('className', data.className);
    event.setExtendedProp('location', data.location);
    event.setExtendedProp('description', data.description);
}

// Function to make API request
async function makeRequest(url, method, data = null) {
    const config = {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    };

    if (data) {
        config.body = JSON.stringify(data);
    }

    const response = await fetch(url, config);
    
    if (!response.ok) {
        throw new Error('Network response was not ok');
    }

    return response.json();
}

// Function to refresh events
async function refreshEvents() {
    toggleLoading(true);
    try {
        const events = await makeRequest(window.calendarRoutes.list, 'GET');
        calendar.removeAllEvents();
        calendar.addEventSource(events);
        upcomingEvents(events);
    } catch (error) {
        console.error('Error refreshing events:', error);
        alert('Failed to refresh events. Please try again.');
    } finally {
        toggleLoading(false);
    }
}

// Initialize calendar with initial events
const calendar = new Calendar(calendarElement, {
    // ... other options ...
    events: window.initialEvents, // Use initial events from server
    eventDidMount: function(info) {
        // Optional: Add tooltips or other event customizations
    }
});

calendar.render();
upcomingEvents(window.initialEvents);

// Handle form submission
formEvent.addEventListener("submit", function (e) {
    e.preventDefault();

    // Get form values
    const eventTitle = document.getElementById("event-title").value;
    const eventCategory = document.getElementById("event-category").value;
    const dateRange = document.getElementById("event-start-date").value.split("to");
    
    // Process start date
    const startDate = new Date(dateRange[0].trim());
    
    // Process end date if exists
    let endDate = new Date(dateRange[1]);
    endDate.setDate(endDate.getDate() + 1);
    const finalEndDate = dateRange[1] ? endDate : "";

    let endDateTime = null;
    let eventLocation = document.getElementById("event-location").value;
    let eventDescription = document.getElementById("event-description").value;
    let eventId = document.getElementById("eventid").value;
    let isAllDay = false;
    let nextId = eventList.length + 1;

    // Handle date and time processing
    if (dateRange.length > 1) {
        // Multi-day event
        endDateTime = new Date(dateRange[1]);
        endDateTime.setDate(endDateTime.getDate() + 1);
        const tempStartDate = new Date(dateRange[0]);
        isAllDay = true;
    } else {
        // Single day event with time
        const dateStr = dateRange[0];
        const startTime = document.getElementById("timepicker1").value.trim();
        const endTime = document.getElementById("timepicker2").value.trim();
        
        // Combine date and time
        const startDateTime = new Date(dateStr + "T" + startTime);
        endDateTime = new Date(dateStr + "T" + endTime);
    }

    // Form validation
    if (formEvent.checkValidity() === false) {
        formEvent.classList.add("was-validated");
        return;
    }

    if (selectedEvent) {
        // Update existing event
        selectedEvent.setProp("id", eventId);
        selectedEvent.setProp("title", eventTitle);
        selectedEvent.setProp("classNames", [eventCategory]);
        selectedEvent.setStart(startDate);
        selectedEvent.setEnd(finalEndDate);
        selectedEvent.setAllDay(isAllDay);
        selectedEvent.setExtendedProp("description", eventDescription);
        selectedEvent.setExtendedProp("location", eventLocation);

        // Update event in list
        const eventIndex = eventList.findIndex(event => event.id == selectedEvent.id);
        if (eventList[eventIndex]) {
            eventList[eventIndex].title = eventTitle;
            eventList[eventIndex].start = startDate;
            eventList[eventIndex].end = finalEndDate;
            eventList[eventIndex].allDay = isAllDay;
            eventList[eventIndex].className = eventCategory;
            eventList[eventIndex].description = eventDescription;
            eventList[eventIndex].location = eventLocation;
        }
        calendar.render();
    } else {
        // Add new event
        const newEvent = {
            id: nextId,
            title: eventTitle,
            start: startDateTime,
            end: endDateTime,
            allDay: isAllDay,
            className: eventCategory,
            description: eventDescription,
            location: eventLocation
        };
        
        calendar.addEvent(newEvent);
        eventList.push(newEvent);
    }

    modalInstance.hide();
    upcomingEvent(eventList);
});

// Handle event deletion
document.getElementById("btn-delete-event").addEventListener("click", function(e) {
    if (selectedEvent) {
        // Remove from event list
        for (let i = 0; i < eventList.length; i++) {
            if (eventList[i].id == selectedEvent.id) {
                eventList.splice(i, 1);
                i--;
            }
        }
        
        upcomingEvent(eventList);
        selectedEvent.remove();
        selectedEvent = null;
        modalInstance.hide();
    }
});

// Handle new event button click
document.getElementById("btn-new-event").addEventListener("click", function(e) {
    flatpicekrValueClear();
    flatPickrInit();
    showNewEventForm();
    
    const editButton = document.getElementById("edit-event-btn");
    editButton.setAttribute("data-id", "new-event");
    editButton.click();
    editButton.setAttribute("hidden", true);
}); 