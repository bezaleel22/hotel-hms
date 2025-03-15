# Room Status Management Implementation

## Overview

This document describes the implementation of room status management that handles the lifecycle: Available -> Booked -> Checked In -> Dirty -> Cleaning -> Available. The implementation uses existing database structure while adding proper state management.

## Database Status Implementation

### Physical Database Status Codes

**booked_info table:**
- 0: Reserved/Pending
- 1: Available (maps to STATE_AVAILABLE)
- 2: Booked (maps to STATE_BOOKED)
- 4: Checked In (maps to STATE_CHECKED_IN)
- 5: Checked Out

**tbl_roomnofloorassign table:**
- 1: Available
- 2: Booked
- 3: Needs Cleaning (Available Rooms)
- 4: Needs Cleaning (Booked Rooms)
- 9: Cleaning in Progress

**tbl_housekeepingrecord table:**
- 0: Pending/Assigned
- 1: Completed
- 2: Under Process

### Status Code Usage
- Room status changes are handled through the Room_status_service
- Service maps physical codes to logical states
- Maintains consistency across database tables
- Provides abstraction for status operations

## Implementation Components

### 1. Room Status Service and State Management

The service layer defines these logical states:
```php
const STATE_AVAILABLE = 'available';
const STATE_BOOKED = 'booked';
const STATE_CHECKED_IN = 'checked_in';
const STATE_DIRTY = 'dirty';
const STATE_CLEANING = 'cleaning';
```

These logical states map to physical database statuses:

**Logical State → Database Mappings**

1. available:
   - booked_info.bookingstatus = 1
   - tbl_roomnofloorassign.status = 1

2. dirty:
   - tbl_roomnofloorassign.status = 3 (for available rooms)
   - tbl_roomnofloorassign.status = 4 (for booked rooms)
   - tbl_housekeepingrecord.status = 0 (pending cleaning)

3. cleaning:
   - tbl_roomnofloorassign.status = 9
   - tbl_housekeepingrecord.status = 2 (under process)

The service abstracts these database codes through:

File: `application/libraries/Room_status_service.php`

- Maps between database status codes and logical states
- Enforces valid state transitions
- Integrates booking status with housekeeping records
- Provides human-readable status labels

### 2. Room Status Helper

File: `application/helpers/room_status_helper.php`

- Provides convenient functions for common status operations
- Easy integration with existing code

## Required File Modifications

### Room Reservation Module

File: `application/modules/room_reservation/controllers/Room_reservation.php`

The checkout process is handled by three primary methods:

1. Checkout Display:

```php
public function checkout($id = null) {
    // Displays checkout view with checked-in rooms
    $data["checkinrooms"] = $this->db->select('b.bookedid,b.room_no,c.firstname')
        ->from("booked_info b")
        ->join("customerinfo c", "c.customerid=b.cutomerid", "left")
        ->where("b.bookingstatus", 4)
        ->get()->result();
}
```

2. Checkout Processing:

```php
public function submitcheckout($bookedid) {
    // Process checkout logic...
    // Update room status to dirty
    $this->load->helper('room_status');
    $rooms = explode(',', $room_no);
    foreach($rooms as $roomId) {
        change_room_status($roomId, 'dirty');
    }
    // Handle payments, taxes, and accounting entries
}
```

3. Checkout Data Preparation:

```php
public function bookingcheckout($id = null) {
    // Prepare checkout data including:
    // - Room details
    // - Payment information
    // - Associated services (pool, restaurant, etc)
    // - Tax calculations
}
```

### House Keeping Module Integration

File: `application/modules/house_keeping/controllers/House_keeping.php`

The housekeeping workflow integrates with the room status management in several ways:

1. Room Status Updates:

```php
// When cleaning begins
public function start_cleaning($roomId) {
    $this->load->helper('room_status');
    change_room_status($roomId, 'cleaning');
    // Update housekeeping record status to "Under Process" (2)
}

// When cleaning completes
public function complete_cleaning($roomId) {
    $this->load->helper('room_status');
    change_room_status($roomId, 'available');
    // Update housekeeping record status to "Completed" (1)
}
```

2. Automated Integration:

- Rooms automatically appear in housekeeping task list after checkout
- Status changes trigger housekeeping record updates
- Room availability is managed through completion workflow

### Configuration

File: `application/config/autoload.php`

```php
$autoload['helper'] = array('room_status');
```

## Status Transitions

### 1. Logical State Flow
```php
$valid_transitions = [
    'available' => ['booked'],
    'booked' => ['checked_in'],
    'checked_in' => ['dirty'],
    'dirty' => ['cleaning'],
    'cleaning' => ['available']
];
```

### 2. Database State Transitions

When logical states change, these database updates occur:

1. available → booked:
   - booked_info.bookingstatus: 1 → 2
   - tbl_roomnofloorassign.status: 1 → 2

2. checked_in → dirty:
   - tbl_roomnofloorassign.status: 1/2 → 3/4
   - New housekeeping record created (status = 0)

3. dirty → cleaning:
   - tbl_roomnofloorassign.status: 3/4 → 9
   - tbl_housekeepingrecord.status: 0 → 2

4. cleaning → available:
   - tbl_roomnofloorassign.status: 9 → 1
   - tbl_housekeepingrecord.status: 2 → 1

The Room_status_service handles these database updates automatically when change_room_status() is called.

## Integration Points

### 1. Room Checkout Process

The checkout process in `submitcheckout()` handles multiple integrations:

1. Room Status Management:

   - Changes room status from "checked_in" (4) to "dirty"
   - Creates pending housekeeping record (status 0)
   - Automatically appears in housekeeping task list

2. Payment Processing:

   - Handles final bill calculations
   - Processes payments and refunds
   - Updates accounting records

3. Service Integration:
   - Pool bookings settlement
   - Restaurant bill clearance
   - Parking charge resolution
   - Hall room booking completion

### 2. Housekeeping Integration

The housekeeping workflow is triggered automatically:

1. After Checkout (`submitcheckout()`):

   - Room status changes to "dirty"
   - Creates housekeeping record with status "pending" (0)
   - Appears in housekeeping dashboard

2. During Cleaning (`start_cleaning()`):

   - Updates housekeeping record to "under process" (2)
   - Changes room status to "cleaning"
   - Updates room status display

3. After Cleaning (`complete_cleaning()`):
   - Updates housekeeping record to "completed" (1)
   - Changes room status to "available"
   - Makes room available for new bookings

## Example Usage

### 1. Room Status Display in Views

```php
// In room list or dashboard view
$this->load->helper('room_status');
foreach($checkinrooms as $room) {
    $status = get_room_status($room->roomid);
    $state = get_room_state($room->roomid);

    // Show appropriate status label and actions
    if($state === 'checked_in') {
        echo "Room {$room->room_no}: $status";
        echo "<button onclick='checkoutRoom({$room->bookedid})'>Checkout</button>";
    }
}
```

### 2. Checkout Processing

```php
// In submitcheckout() method
public function submitcheckout($bookedid) {
    $this->load->helper('room_status');
    $room_info = $this->db->get_where('booked_info', ['bookedid' => $bookedid])->row();

    $room_numbers = explode(',', $room_info->room_no);
    foreach($room_numbers as $room_no) {
        // Change status and create housekeeping record
        change_room_status($room_no, 'dirty');
    }
}
```

### 3. Housekeeping Integration

```php
// In housekeeping controller
public function get_cleaning_tasks() {
    $this->load->helper('room_status');

    // Get rooms needing attention
    $dirty_rooms = array_filter($this->get_all_rooms(), function($room) {
        return get_room_state($room->roomid) === 'dirty';
    });

    return $dirty_rooms;
}
```

## CodeIgniter Integration Notes

### Intelephense Error Fix

To handle Intelephense property errors in CodeIgniter libraries:

1. Add proper property declarations:

```php
class My_Library {
    /** @var CI_Controller */
    private $CI;

    /** @var CI_DB_query_builder */
    private $db;
}
```

2. Initialize properties correctly:

```php
public function __construct() {
    $this->CI =& get_instance();
    require_once BASEPATH.'database/DB.php';
    $this->db =& DB();
}
```

3. Use class properties consistently:

```php
// Instead of: $this->CI->db->where(...)
$this->db->where(...);
```

### Benefits:

- Proper IDE support and code completion
- No Intelephense errors
- Better code organization
- Improved performance (no repeated property lookups)

## Technical Notes

1. No database schema changes required
2. Maintains compatibility with existing code
3. Proper state transition enforcement
4. Integrated housekeeping workflow
5. Clear status display for staff and system

## Views Integration

### Room List Display

File: `application/modules/room_reservation/views/roomlist.php`

- Use helper function to show status
- Display appropriate status labels
- Update status indicators

### Housekeeping Interface

File: `application/modules/house_keeping/views/room_cleaning.php`

- Show rooms needing cleaning
- Display cleaning progress
- Update status after completion
