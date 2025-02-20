INSERT INTO `language` (`id`, `phrase`, `english`) VALUES 
(NULL, 'transport_facility', 'Transport Facility'),
(NULL, 'flight_details_list', 'Flight Details List'),
(NULL, 'fl_details_add', 'Flight Details Add'),
(NULL, 'flight_num', 'Flight Number'),
(NULL, 'airlience_name', 'Airlience Name'),
(NULL, 'departure', 'Departure'),
(NULL, 'arrival', 'Arrival'),
(NULL, 'fly_from', 'Fly From'),
(NULL, 'fly_to', 'Fly To'),
(NULL, 'fl_details_update', 'Flight Details Update'),
(NULL, 'vehicle_details_list', 'Vehicle Details List'),
(NULL, 'vehicle_details_add', 'Vehicle Details Add'),
(NULL, 'vehicle_details_edit', 'Vehicle Details Update'),
(NULL, 'vehicle_number', 'Vehicle Number'),
(NULL, 'vehicle_type', 'Vehicle Type'),
(NULL, 'fuel_type', 'Fuel Type'),
(NULL, 'seat_capacity', 'Seat Capacity'),
(NULL, 'driver', 'Driver'),
(NULL, 'vehicle_booking_report', 'Vehicle Booking Report'),
(NULL, 'vehicle_booking_list', 'Vehicle Booking List'),
(NULL, 'vehicle_booking_add', 'Vehicle Booking Add'),
(NULL, 'vehicle_booking_edit', 'Vehicle Booking Update'),
(NULL, 'transportation_type', 'Transportation Type'),
(NULL, 'assigned_driver', 'Assigned Driver'),
(NULL, 'pick_up', 'Pick Up'),
(NULL, 'drop_off', 'Drop Off'),
(NULL, 'transportation_time', 'Transportation Time');

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) 
VALUES('transport_facility', 'transport_facility', 'transport_facility', 0, 0, 1, '2021-10-20 00:00:00');

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) 
SELECT 'flight_details_list', 'flight-list', 'transport_facility', sec_menu_item.menu_id, '0', '1', '2021-10-20 00:00:00' 
FROM sec_menu_item WHERE sec_menu_item.menu_title = 'transport_facility';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) 
SELECT 'vehicle_details_list', 'vehicle-list', 'transport_facility', sec_menu_item.menu_id, '0', '1', '2021-06-06 00:00:00' 
FROM sec_menu_item WHERE sec_menu_item.menu_title = 'transport_facility';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) 
SELECT 'vehicle_booking_list', 'vehicle-booking-list', 'transport_facility', sec_menu_item.menu_id, '0', '1', '2021-06-06 00:00:00' 
FROM sec_menu_item WHERE sec_menu_item.menu_title = 'transport_facility';

INSERT INTO `position` (`pos_id`, `position_name`, `position_details`) VALUES (17, 'Driver', 'Drive a Specific Vehicle for Pic up & Drop off Customer');
