# MM Smart Campus

A comprehensive school management system built with Laravel 12 and React using Inertia.js.

## Features

### Authentication & User Management
- User registration and login
- Password reset functionality
- Email verification
- Profile management
- Settings management (profile, password, appearance)

### API Endpoints (v1)
The system provides a comprehensive REST API for school management:

#### Authentication
- `POST /api/v1/login` - User login
- `POST /api/v1/logout` - User logout (requires authentication)

#### Student Management ✅ *Implemented*
- `GET /api/v1/students` - List all students (paginated)
- `POST /api/v1/students` - Create a new student
- `GET /api/v1/students/{id}` - Get student details
- `PUT /api/v1/students/{id}` - Update student
- `DELETE /api/v1/students/{id}` - Delete student

#### Other Endpoints (Planned)
- User management (`/api/v1/users`)
- Role management (`/api/v1/roles`)
- Staff management (`/api/v1/staff`)
- Teacher management (`/api/v1/teachers`)
- Guardian management (`/api/v1/guardians`)
- Class management (`/api/v1/classes`)
- Subject management (`/api/v1/subjects`)
- Event management (`/api/v1/events`)
- Exam management (`/api/v1/exams`)
- Leave request management (`/api/v1/leaves`)
- Finance management (`/api/v1/finances`)
- Schedule management (`/api/v1/schedules`)
- Announcement management (`/api/v1/announcements`)
- Attendance management (`/api/v1/attendances`)
- Academic year management (`/api/v1/academic-years`)
- Batch management (`/api/v1/batches`)

## Technology Stack

- **Backend**: Laravel 12, PHP 8.2+
- **Frontend**: React 19, TypeScript
- **UI Framework**: Inertia.js
- **Styling**: TailwindCSS 4.0, Radix UI
- **Authentication**: Laravel Sanctum (API), Laravel Breeze (Web)
- **Database**: MySQL/SQLite
- **Testing**: Pest PHP, PHPUnit
- **Build Tools**: Vite 6
- **Code Quality**: ESLint, Prettier, Laravel Pint

## Installation

1. Clone the repository
```bash
git clone https://github.com/ChanMyaeLwin/mm-smart-campus.git
cd mm-smart-campus
```

2. Install dependencies
```bash
composer install
npm install
```

3. Environment setup
```bash
cp .env.example .env
php artisan key:generate
```

4. Database setup
```bash
php artisan migrate
php artisan db:seed # Optional
```

5. Build frontend assets
```bash
npm run build
```

## Development

### Running the application
```bash
# Run all services (server, queue, logs, vite)
composer dev

# Or run individually
php artisan serve
npm run dev
```

### Code Quality

```bash
# Frontend
npm run lint          # ESLint
npm run format        # Prettier formatting
npm run format:check  # Check formatting

# Backend
./vendor/bin/pint     # Laravel Pint code formatting
```

### Testing

```bash
# Run all tests
php artisan test

# Run specific test suites
php artisan test --testsuite=Feature
php artisan test --testsuite=Unit

# Run with coverage
php artisan test --coverage
```

## API Usage

### Authentication
All API endpoints (except login) require authentication using Laravel Sanctum tokens.

1. Login to get a token:
```bash
curl -X POST http://localhost:8000/api/v1/login \
  -H "Content-Type: application/json" \
  -d '{"email": "user@example.com", "password": "password"}'
```

2. Use the token for subsequent requests:
```bash
curl -H "Authorization: Bearer YOUR_TOKEN" \
  http://localhost:8000/api/v1/students
```

### Student Management Examples

**List students:**
```bash
GET /api/v1/students
```

**Create a student:**
```bash
POST /api/v1/students
Content-Type: application/json
{
  "user_id": 1,
  "first_name": "John",
  "last_name": "Doe",
  "date_of_birth": "2000-01-01",
  "gender": "male",
  "address": "123 Main St",
  "phone_number": "+1234567890",
  "enrollment_date": "2023-09-01"
}
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## Security

This application implements several security best practices:
- CSRF protection
- SQL injection prevention through Eloquent ORM
- XSS protection via proper data sanitization
- Authentication rate limiting
- Secure password hashing
- API authentication via Laravel Sanctum

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).