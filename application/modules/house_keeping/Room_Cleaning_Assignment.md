# Room Cleaning Assignment Workflow via Duty Roster

## Overview
The duty roster module manages room cleaning assignments through a structured system of shifts, rosters, and employee assignments. This document details how to use the duty roster module to manage room cleaning staff schedules.

## Database Structure

### 1. Work Shifts Table (tbl_empwork_shift)
- shiftid (Primary Key)
- shift_name
- shift_start (Time)
- shift_end (Time)
- shift_duration

### 2. Duty Roster Table (tbl_duty_roster)
- roster_id (Primary Key)
- rostentry_id
- shift_id (References tbl_empwork_shift)
- roster_start (Date)
- roster_end (Date)
- roster_dsys (Days)

### 3. Employee Roster Assignments (tbl_emproster_assign)
- sftasnid (Primary Key)
- roster_id (References tbl_duty_roster)
- emp_id
- emp_startroster_date
- emp_endroster_date
- emp_startroster_time
- emp_endroster_time
- is_edited

## Assignment Process

### 1. Create Cleaning Shifts
```
Path: duty_roster/Shift_management/create_shift
```
- Define shift timings for cleaning staff
- System validates to prevent overlapping shifts
- Each shift requires:
  * Shift name
  * Start time
  * End time
  * Duration (auto-calculated)

### 2. Create Duty Roster
```
Path: duty_roster/Shift_management/create_roster
```
- Set roster period (start and end dates)
- Select applicable shifts
- System generates unique roster ID (format: "RS" + 7 random chars)
- System validates schedule conflicts

### 3. Assign Staff to Roster
```
Path: duty_roster/Shift_management/create_shift_assign
```
- Select roster from available templates
- View eligible employees
- System shows:
  * Employee names
  * Current positions
  * Assignment status
- System prevents:
  * Double booking
  * Schedule conflicts
  * Invalid assignments

## Key Features

### 1. Schedule Validation
- Prevents overlapping shift assignments
- Validates roster dates
- Checks employee availability

### 2. Assignment Management
- Edit assignments
- Remove assignments
- Track modified schedules
- View current assignments

### 3. Schedule Views
- Current day view
- Date-based roster view
- Employee-based schedule view
- Shift-based view

## API Endpoints

### Shift Management
- Create: POST `/duty_roster/Shift_management/create_shift`
- Update: POST `/duty_roster/Shift_management/update_shift_form`
- Delete: POST `/duty_roster/Shift_management/delete_shift`

### Roster Management
- Create: POST `/duty_roster/Shift_management/create_roster`
- Update: POST `/duty_roster/Shift_management/update_roster_data`
- Delete: POST `/duty_roster/Shift_management/delete_roster`

### Assignment Management
- Create: POST `/duty_roster/Shift_management/create_shift_assign`
- Update: POST `/duty_roster/Shift_management/update_shiftassign`
- Delete: POST `/duty_roster/Shift_management/delete_shiftassign`

## System Validations

1. Shift Time Validation
```sql
WHERE cast(shift_start AS Time) >= [start_time]
  AND cast(shift_end AS Time) <= [end_time]
```

2. Roster Date Validation
```sql
WHERE roster_start <= [start_date]
  AND roster_end >= [end_date]
```

3. Employee Assignment Validation
```sql
WHERE emp_startroster_date >= [date]
  AND emp_endroster_date <= [date]
  AND emp_id = [employee_id]
```

## User Interface Elements

### 1. Shift Assignment View
- Roster selection dropdown
- Employee list with checkboxes
- Submit assignment button
- Assignment date range display

### 2. Schedule Management
- Calendar view
- Employee list
- Shift timing display
- Status indicators

### 3. Assignment History
- Assignment details
- Modification history
- Current status
- Schedule conflicts