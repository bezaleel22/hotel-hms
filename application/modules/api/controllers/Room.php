<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Room extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/room_model');
        $this->load->library('api/api_handler');
    }

    public function list()
    {
        try {
            $filters = [
                'type' => $this->input->get('type'),
                'capacity' => $this->input->get('capacity'),
                'status' => $this->input->get('status')
            ];

            $rooms = $this->room_model->get_rooms($filters);
            
            $this->api_handler->send_response([
                'rooms' => $rooms,
                'total' => count($rooms)
            ]);
        } catch (Exception $e) {
            error_log('Error fetching rooms: ' . $e->getMessage());
            $this->api_handler->send_error('Failed to fetch rooms', 500);
        }
    }

    public function details($id)
    {
        try {
            $room = $this->room_model->get_room_details($id);
            $this->api_handler->send_response(['room' => $room]);
        } catch (Exception $e) {
            if ($e->getMessage() === 'Room not found') {
                $this->api_handler->send_error('Room not found', 404);
            } else {
                error_log('Error fetching room details: ' . $e->getMessage());
                $this->api_handler->send_error('Failed to fetch room details', 500);
            }
        }
    }

    public function check_availability()
    {
        try {
            $room_id = $this->input->get('room_id');
            $checkin = $this->input->get('checkin');
            $checkout = $this->input->get('checkout');

            if (!$room_id || !$checkin || !$checkout) {
                $this->api_handler->send_error('Missing required parameters', 400);
                return;
            }

            $availability = $this->room_model->check_availability(
                $room_id,
                $checkin,
                $checkout
            );

            $this->api_handler->send_response($availability);
        } catch (Exception $e) {
            if ($e->getMessage() === 'Invalid date range') {
                $this->api_handler->send_error('Invalid date range', 400);
            } else {
                error_log('Error checking availability: ' . $e->getMessage());
                $this->api_handler->send_error('Failed to check availability', 500);
            }
        }
    }

    public function types()
    {
        try {
            $types = $this->room_model->get_room_types();
            $this->api_handler->send_response(['types' => $types]);
        } catch (Exception $e) {
            error_log('Error fetching room types: ' . $e->getMessage());
            $this->api_handler->send_error('Failed to fetch room types', 500);
        }
    }

    public function facilities()
    {
        try {
            $room_id = $this->input->get('room_id');
            $facilities = $this->room_model->get_room_facilities($room_id);
            $this->api_handler->send_response(['facilities' => $facilities]);
        } catch (Exception $e) {
            error_log('Error fetching facilities: ' . $e->getMessage());
            $this->api_handler->send_error('Failed to fetch facilities', 500);
        }
    }
}
