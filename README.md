# Employee Data Processor

## Overview
This project provides a unified API for handling employee data from two distinct providers and creating or updating records in the TrackTik system. The system includes transformations to ensure compatibility with the TrackTik employee schema and utilizes JWT token for authorization.

## Getting Started

### Requirements:
- PHP 8.2 or higher
- Composer 2x 

### Installation
Clone the repository and run the following command to install the necessary dependencies:
```bash
composer install
```

### Environment Configuration
```bash
cp .env.example .env
```

### Start the Application
```bash
php artisan serve
```
### API Endpoints
All API requests require the use of a JWT provided in the request header. Ensure you include the following header:
```bash
Authorization: Bearer YOUR_JWT_HERE
```
**Note:** Only the provider names provider1 and provider2 are valid for the API endpoints. Using any other provider name will result in an error.

**Creating Employee Records**
```bash
POST /api/{provider}/employees
```
This endpoint is used to create new employee records in the TrackTik system based on the data provided by one of the two configured providers.

**Required Data Fields:**

Provider 1: email, first_name, last_name

Provider 2: email, first-name, last-name

**Optional Data Fields:**

Provider 1: username, jobTitle, primaryPhone

Provider 2: username, jobTitle

**Updating Employee Records**
```bash
POST /api/{provider}/employees/{id}
```

This endpoint updates existing employee records in the TrackTik system. The endpoint ensures that the employee exists before attempting an update (using the EnsureEmployeeExists middleware).

**General Requirement:**

At least one valid field must be present in the request body for the update to proceed.



