<?php
namespace App\Modules\Api\Models;

use CodeIgniter\Model;

class AppointmentModel extends Model
{
    protected $table = 'appointment';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'requester_id',
        'participant_id',
        'start_time',
        'end_time',
        'status',
        'notes',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Get all appointments for a participant (both requested and received)
    public function getParticipantAppointments($participantId)
    {
        return $this->where('participant_id', $participantId)
                    ->orWhere('requester_id', $participantId)
                    ->join('participant as requester', 'requester.id = appointment.requester_id')
                    ->join('participant as participant', 'participant.id = appointment.participant_id')
                    ->select('appointment.*, 
                            requester.prenom as requester_firstname,
                            requester.nom as requester_lastname,
                            participant.prenom as participant_firstname,
                            participant.nom as participant_lastname')
                    ->findAll();
    }

    // Get pending appointment requests for a participant
    public function getPendingRequests($participantId)
    {
        return $this->where('participant_id', $participantId)
                    ->where('status', 'pending')
                    ->join('participant', 'participant.id = appointment.requester_id')
                    ->select('appointment.*, participant.prenom, participant.nom')
                    ->findAll();
    }

    // Update appointment status
    public function updateStatus($appointmentId, $status)
    {
        return $this->update($appointmentId, [
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    // Check if timeslot is available
    public function isTimeSlotAvailable($participantId, $startTime, $endTime)
    {
        $overlapping = $this->where('participant_id', $participantId)
                           ->where('status !=', 'rejected')
                           ->groupStart()
                                ->where('start_time <', $endTime)
                                ->where('end_time >', $startTime)
                           ->groupEnd()
                           ->countAllResults();
        
        return $overlapping === 0;
    }
}