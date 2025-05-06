"use strict";

// Calendar initialization
var AppointmentCalendar = function() {
    // Handle modal actions based on user role and appointment status
    var handleModalActions = function(event) {
        var modal = $('#appointmentDetailsModal');
        var adminActions = modal.find('.admin-actions');
        var appointmentActions = modal.find('.appointment-actions');
        
        // Clear previous actions
        appointmentActions.empty();
        
        // Set status label color
        var statusLabel = modal.find('.appointment-status');
        statusLabel.removeClass('label-light-primary label-light-warning label-light-success label-light-danger');
        
        switch(event.extendedProps.status) {
            case 'pending':
                statusLabel.addClass('label-light-warning');
                if (event.extendedProps.isAdmin) {
                    adminActions.show();
                }
                break;
            case 'approved':
                statusLabel.addClass('label-light-success');
                if (!event.extendedProps.isAdmin) {
                    appointmentActions.append(
                        '<button type="button" class="btn btn-sm btn-danger action-cancel">Cancel Appointment</button>'
                    );
                }
                break;
            case 'rejected':
                statusLabel.addClass('label-light-danger');
                if (!event.extendedProps.isAdmin) {
                    appointmentActions.append(
                        '<button type="button" class="btn btn-sm btn-primary action-reschedule">Request Reschedule</button>'
                    );
                }
                break;
        }
    };

    var initCalendar = function(elementId, events, availability) {
        var calendarEl = document.getElementById(elementId);
        if (!calendarEl) return;

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialView: 'timeGridWeek',
            slotMinTime: '08:00:00',
            slotMaxTime: '18:00:00',
            events: events,
            businessHours: availability,
            eventClick: function(info) {
                var event = info.event;
                var modal = $('#appointmentDetailsModal');
                
                // Set modal content
                modal.find('.appointment-title').text(event.title);
                modal.find('.appointment-time').text(
                    moment(event.start).format('MMMM D, YYYY h:mm A') + ' - ' + 
                    moment(event.end).format('h:mm A')
                );
                modal.find('.appointment-status').text(event.extendedProps.status);
                modal.find('.appointment-notes').text(event.extendedProps.notes || 'No notes');
                
                // Setup modal actions
                handleModalActions(event);
                
                // Show modal
                modal.modal('show');
            }
        });

        calendar.render();
        return calendar;
    };

    // Handle appointment actions
    var handleAppointmentActions = function() {
        var modal = $('#appointmentDetailsModal');
        
        // Approve appointment
        modal.on('click', '.action-approve', function() {
            var appointmentId = modal.data('appointmentId');
            $.ajax({
                url: BASE_URL + '/participants/approve-appointment/' + appointmentId,
                method: 'POST',
                success: function(response) {
                    toastr.success('Appointment approved successfully');
                    modal.modal('hide');
                    // Refresh calendar
                    window.location.reload();
                },
                error: function() {
                    toastr.error('Failed to approve appointment');
                }
            });
        });
        
        // Reject appointment
        modal.on('click', '.action-reject', function() {
            var appointmentId = modal.data('appointmentId');
            $.ajax({
                url: BASE_URL + '/participants/reject-appointment/' + appointmentId,
                method: 'POST',
                success: function(response) {
                    toastr.success('Appointment rejected successfully');
                    modal.modal('hide');
                    // Refresh calendar
                    window.location.reload();
                },
                error: function() {
                    toastr.error('Failed to reject appointment');
                }
            });
        });
        
        // Cancel appointment
        modal.on('click', '.action-cancel', function() {
            if (confirm('Are you sure you want to cancel this appointment?')) {
                var appointmentId = modal.data('appointmentId');
                $.ajax({
                    url: BASE_URL + '/participants/cancel-appointment/' + appointmentId,
                    method: 'POST',
                    success: function(response) {
                        toastr.success('Appointment cancelled successfully');
                        modal.modal('hide');
                        // Refresh calendar
                        window.location.reload();
                    },
                    error: function() {
                        toastr.error('Failed to cancel appointment');
                    }
                });
            }
        });
        
        // Request reschedule
        modal.on('click', '.action-reschedule', function() {
            var appointmentId = modal.data('appointmentId');
            window.location.href = BASE_URL + '/participants/reschedule-appointment/' + appointmentId;
        });
    };

    return {
        init: function() {
            handleAppointmentActions();
        },
        
        initCalendar: function(elementId, events, availability) {
            return initCalendar(elementId, events, availability);
        }
    };
}();

// Initialize on document ready
jQuery(document).ready(function() {
    AppointmentCalendar.init();
});