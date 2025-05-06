<?php
namespace App\Modules\Api\Models;

use CodeIgniter\Model;

class AvailabilityModel extends Model
{
    protected $table = 'availability';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'participant_id',
        'day_of_week',
        'start_time',
        'end_time',
        'is_active'
    ];

    // Get all active availability slots for a participant
    public function getParticipantAvailability($participantId)
    {
        return $this->where('participant_id', $participantId)
                    ->where('is_active', true)
                    ->orderBy('day_of_week', 'ASC')
                    ->orderBy('start_time', 'ASC')
                    ->findAll();
    }

    // Check if a specific time is within participant's availability
    public function isWithinAvailability($participantId, $datetime)
    {
        $dayOfWeek = date('w', strtotime($datetime));
        $time = date('H:i', strtotime($datetime));

        return $this->where('participant_id', $participantId)
                    ->where('day_of_week', $dayOfWeek)
                    ->where('start_time <=', $time)
                    ->where('end_time >', $time)
                    ->where('is_active', true)
                    ->countAllResults() > 0;
    }

    // Update or create availability slots
    public function updateAvailability($participantId, $slots)
    {
        // First deactivate all existing slots
        $this->where('participant_id', $participantId)
             ->set(['is_active' => false])
             ->update();

        // Then insert new slots
        foreach ($slots as $slot) {
            $this->insert([
                'participant_id' => $participantId,
                'day_of_week' => $slot['day_of_week'],
                'start_time' => $slot['start_time'],
                'end_time' => $slot['end_time'],
                'is_active' => true
            ]);
        }
        return true;
    }

    // Get available time slots for a specific day
    public function getAvailableSlots($participantId, $date)
    {
        $dayOfWeek = date('w', strtotime($date));
        return $this->where('participant_id', $participantId)
                    ->where('day_of_week', $dayOfWeek)
                    ->where('is_active', true)
                    ->orderBy('start_time', 'ASC')
                    ->findAll();
    }
}