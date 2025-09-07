# MM Smart Campus API Documentation

## Base URL
```
http://localhost:8000/api/v1
```

## Authentication

All API endpoints (except login) require a Bearer token in the Authorization header.

### Login
```http
POST /api/v1/login
Content-Type: application/json

{
  "email": "admin@example.com",
  "password": "password"
}
```

Response:
```json
{
  "message": "Login successful",
  "user": {
    "id": 1,
    "name": "Admin User",
    "email": "admin@example.com",
    "email_verified_at": null,
    "created_at": "2023-01-01T00:00:00.000000Z",
    "updated_at": "2023-01-01T00:00:00.000000Z"
  },
  "token": "1|abcdefghijklmnopqrstuvwxyz"
}
```

### Logout
```http
POST /api/v1/logout
Authorization: Bearer YOUR_TOKEN
```

## Students API

### List Students
```http
GET /api/v1/students
Authorization: Bearer YOUR_TOKEN
```

Response:
```json
{
  "data": [
    {
      "id": 1,
      "user_id": 2,
      "first_name": "John",
      "last_name": "Doe",
      "date_of_birth": "2000-01-01",
      "gender": "male",
      "address": "123 Main Street",
      "phone_number": "+1234567890",
      "enrollment_date": "2023-09-01",
      "created_at": "2023-01-01T00:00:00.000000Z",
      "updated_at": "2023-01-01T00:00:00.000000Z",
      "user": {
        "id": 2,
        "name": "John Doe",
        "email": "john@example.com",
        "email_verified_at": null,
        "created_at": "2023-01-01T00:00:00.000000Z",
        "updated_at": "2023-01-01T00:00:00.000000Z"
      }
    }
  ],
  "meta": {
    "current_page": 1,
    "last_page": 1,
    "per_page": 15,
    "total": 1
  }
}
```

### Create Student
```http
POST /api/v1/students
Authorization: Bearer YOUR_TOKEN
Content-Type: application/json

{
  "user_id": 2,
  "first_name": "John",
  "last_name": "Doe",
  "date_of_birth": "2000-01-01",
  "gender": "male",
  "address": "123 Main Street",
  "phone_number": "+1234567890",
  "enrollment_date": "2023-09-01"
}
```

### Get Student
```http
GET /api/v1/students/{id}
Authorization: Bearer YOUR_TOKEN
```

### Update Student
```http
PUT /api/v1/students/{id}
Authorization: Bearer YOUR_TOKEN
Content-Type: application/json

{
  "first_name": "Jane",
  "last_name": "Smith"
}
```

### Delete Student
```http
DELETE /api/v1/students/{id}
Authorization: Bearer YOUR_TOKEN
```

## Error Responses

### Validation Error (422)
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "first_name": [
      "The first name field is required."
    ]
  }
}
```

### Unauthorized (401)
```json
{
  "message": "Unauthenticated."
}
```

### Not Found (404)
```json
{
  "message": "No query results for model [App\\Models\\Student] 999"
}
```

### Server Error (500)
```json
{
  "message": "Server Error"
}
```

## Field Validation Rules

### Student Creation/Update
- `user_id`: required (create only), must exist in users table
- `first_name`: required, string, max 255 characters
- `last_name`: required, string, max 255 characters  
- `date_of_birth`: required, valid date, must be before today
- `gender`: required, must be one of: male, female, other
- `address`: required, string
- `phone_number`: required, string, max 20 characters
- `enrollment_date`: required, valid date