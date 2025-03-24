<?php
@mysqli_connect("db", "devuser", "paxxw0rd@2791", "devdb", 3306);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
    echo "Connected to MySQL";
}
// phpinfo();


    public function create_booking($customerid, $data)
    {
        $this->db->trans_start();

        try {
            // Validate required fields
            $required_fields = ['checkin', 'checkout', 'room_no'];
            foreach ($required_fields as $field) {
                if (empty($data[$field])) {
                    throw new Exception("Missing required field: {$field}");
                }
            }

            // Standardize dates and field names
            $datefilter1 = $data['checkin'];
            $datefilter2 = $data['checkout'];
            $room_numbers = array_map('trim', explode(',', $data['room_no'] ?? $data['roomno']));
            $total_rooms = count($room_numbers);
            
            // Check date validity
            if ($datefilter2 <= $datefilter1) {
                throw new Exception("Checkout date must be after checkin date");
            }

            // Validate room availability for all rooms
            foreach ($room_numbers as $room_no) {
                $status = "bookingstatus != 1 AND bookingstatus != 5";
                $croom = "FIND_IN_SET(" . $room_no . ", room_no)";
                
                // Check existing bookings
                $exits = $this->db->select("*")
                    ->from('booked_info')
                    ->where('checkindate <=', $datefilter1)
                    ->where('checkoutdate >', $datefilter1)
                    ->where($status)
                    ->where("$croom !=", 0)
                    ->get()->result();

                $exit = $this->db->select("*")
                    ->from('booked_info')
                    ->where('checkindate <', $datefilter2)
                    ->where('checkoutdate >=', $datefilter2)
                    ->where($status)
                    ->where("$croom !=", 0)
                    ->get()->result();

                if (!empty($exits) || !empty($exit)) {
                    throw new Exception("Room {$room_no} is not available for the selected dates");
                }
            }

            // Generate main booking number
            $main_booking_number = $this->booking->generateBookingNumber();
            $booking_ids = [];
            $total_amount = 0;

            // Split all comma-separated fields
            $splitFields = [
                'room_type',
                'name',
                'mobile',
                'email',
                'lastname',
                'gender',
                'father',
                'occupation',
                'dob',
                'anniversary',
                'pitype',
                'pid',
                'imgfront',
                'imgback',
                'imgguest',
                'contacttype',
                'state',
                'city',
                'zipcode',
                'address',
                'country',
                'bed',
                'amount1',
                'person',
                'amount2',
                'child',
                'amount3',
                'extrastart',
                'extraend',
                'rent',
                'discount_price',
                'complementary',
                'complementaryprice'
            ];

            $splitData = [];
            foreach ($splitFields as $field) {
                if (isset($data[$field])) {
                    $splitData[$field] = array_map('trim', explode(',', $data[$field]));
                }
            }

            // Process each room
            foreach ($room_numbers as $index => $room_number) {
                // Check availability for each room
                $availability = $this->booking->checkRoomAvailability(
                    $room_number,
                    $data['checkin'],
                    $data['checkout']
                );
                if (!$availability['is_available']) {
                    throw new Exception("Room {$room_number}: {$availability['reason']}");
                }

                // Calculate amount for this room
                $room_data = array_merge($data, ['room_no' => $room_number]);
                if (isset($splitData['rent'][$index])) {
                    $room_data['rent'] = $splitData['rent'][$index];
                }
                $amount = $this->booking->calculateBookingAmount($customerid, $room_data);
                $total_amount += $amount['total_amount'];

                // Get guest name for this room
                $guestName = $splitData['name'][$index] ?? $data['full_name'];

                // Prepare booking data for this room
                $bookingData = [
                    'booking_number' => $main_booking_number . '-' . ($index + 1),
                    'date_time' => date('Y-m-d H:i:s'),
                    'roomid' => $availability['room_id'],
                    'room_no' => $room_number,
                    'roomrate' => $splitData['rent'][$index] ?? $availability['rate'],
                    'total_price' => $amount['total_amount'],
                    'checkindate' => $availability['checkin'],
                    'checkoutdate' => $availability['checkout'],
                    'cutomerid' => $customerid,
                    'full_guest_name' => $guestName,
                    'bookingstatus' => Booking_handler::STATUS_BOOKED,
                    'nuofpeople' => isset($data['adults']) ? array_map('trim', explode(',', $data['adults']))[$index] ?? 1 : 1,
                    'children' => isset($data['children']) ? array_map('trim', explode(',', $data['children']))[$index] ?? 0 : 0,
                    'total_room' => $total_rooms,
                    'offer_discount' => isset($splitData['discount_price']) ? $splitData['discount_price'][$index] : 0,
                    'paid_amount' => ($data['advance_amount'] ?? 0) / $total_rooms,
                    'coments' => $data['booking_remarks'] ?? 'Multi-room booking'
                ];

                if (!$this->db->insert('booked_info', $bookingData)) {
                    throw new Exception("Failed to create booking for room {$room_number}");
                }

                $bookingId = $this->db->insert_id();
                $booking_ids[] = $bookingId;

                // Store guest data for additional guests
                if ($index > 0) {
                    $guestData = [
                        'bookedid' => $bookingId,
                        'guestname' => $guestName,
                        'mobile' => $splitData['mobile'][$index] ?? null,
                        'email' => $splitData['email'][$index] ?? null,
                        'gender' => $splitData['gender'][$index] ?? null,
                        'photo_id_type' => $splitData['pitype'][$index] ?? null,
                        'photo_id' => $splitData['pid'][$index] ?? null,
                        'front_image' => $splitData['imgfront'][$index] ?? null,
                        'back_image' => $splitData['imgback'][$index] ?? null,
                        'occupant_image' => $splitData['imgguest'][$index] ?? null
                    ];
                    
                    // Insert other guest data
                    $this->db->insert('tbl_otherguest', $guestData);
                }

                // Store guest images if provided
                if (isset($splitData['imgfront'][$index])) {
                    $this->saveGuestImages($bookingId, [
                        'front' => $splitData['imgfront'][$index],
                        'back' => $splitData['imgback'][$index] ?? '',
                        'guest' => $splitData['imgguest'][$index] ?? ''
                    ]);
                }

                // Calculate extra days for this room
                $extra_days = 0;
                if (!empty($splitData['extrastart'][$index]) && !empty($splitData['extraend'][$index])) {
                    $start_date = strtotime($splitData['extrastart'][$index]);
                    $end_date = strtotime($splitData['extraend'][$index]);
                    $diff = $end_date - $start_date;
                    $extra_days = ceil($diff / (60 * 60 * 24));
                }

                // Create booking details for this room
                $bdetails_data = [
                    'bookedid' => $bookingId,
                    'booking_type' => $data['booking_type'] ?? 'Online',
                    'booking_source' => $data['booking_source'] ?? 'Website',
                    'booking_source_no' => $data['bsorurce_no'] ?? '1',
                    'purpose' => $data['pof_visit'] ?? null,
                    'arrival_from' => $data['arrival_from'] ?? null,
                    'extrabed' => $splitData['bed'][$index] ?? 0,
                    'extraperson' => $splitData['person'][$index] ?? 0,
                    'extrachild' => $splitData['child'][$index] ?? 0,
                    'extracheckin' => $splitData['extrastart'][$index] ?? null,
                    'extracheckout' => $splitData['extraend'][$index] ?? null,
                    'extra_facility_days' => $extra_days,
                    'bed_charge' => $splitData['amount1'][$index] ?? 0,
                    'person_charge' => $splitData['amount2'][$index] ?? 0,
                    'child_charge' => $splitData['amount3'][$index] ?? 0,
                    'complementary' => $splitData['complementary'][$index] ?? 'no',
                    'complementary_price' => $splitData['complementaryprice'][$index] ?? 0,
                    'discountreason' => $data['discountreason'] ?? null,
                    'discountamount' => ($data['discountamount'] ?? 0) / $total_rooms,
                    'commissionpersent' => $data['commissionrate'] ?? 0,
                    'commissionamount' => ($data['commissionamount'] ?? 0) / $total_rooms,
                    'payment_method' => $data['paymentmode'] ?? null,
                    'advance_amount' => ($data['advance_amount'] ?? 0) / $total_rooms,
                    'advance_remarks' => $data['advance_remarks'] ?? null,
                    'remarks' => $data['booking_remarks'] ?? null
                ];

                // Process advance payment if provided
                if (!empty($data['advance_amount'])) {
                    $this->process_advance_payment($bookingId, $customerid, $data['advance_amount'] / $total_rooms, $data['paymentmode'] ?? null);
                }

                $this->db->insert('booked_details', $bdetails_data);

                // Update room status
                $this->db->where('roomno', $room_number)
                    ->update(
                        'tbl_roomnofloorassign',
                        ['status' => Booking_handler::ROOM_STATUS_OCCUPIED]
                    );
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Transaction failed');
            }

            return [
                'main_booking_number' => $main_booking_number,
                'booking_ids' => $booking_ids,
                'total_rooms' => $total_rooms,
                'total_amount' => $total_amount
            ];
        } catch (Exception $e) {
            $this->db->trans_rollback();
            throw $e;
        }
    }