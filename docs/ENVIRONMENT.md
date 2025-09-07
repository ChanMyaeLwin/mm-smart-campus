# Environment Configuration Guide

## Required Environment Variables

Create a `.env` file from `.env.example` and configure the following:

### Application Configuration
```bash
APP_NAME="MM Smart Campus"
APP_ENV=local  # local, staging, production
APP_KEY=     # Generate with: php artisan key:generate
APP_DEBUG=true  # false in production
APP_URL=http://localhost:8000
```

### Database Configuration

#### For Development (SQLite - Recommended)
```bash
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
```

#### For Production (MySQL)
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mm_smart_campus
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Mail Configuration
```bash
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="${MAIL_USERNAME}"
MAIL_FROM_NAME="${APP_NAME}"
```

### Cache and Sessions
```bash
CACHE_DRIVER=file  # file, redis, memcached
SESSION_DRIVER=file  # file, database, redis
QUEUE_CONNECTION=sync  # sync, database, redis
```

## Security Configuration

### Production Security Settings
```bash
APP_ENV=production
APP_DEBUG=false
APP_KEY=your-32-character-secret-key

# Use secure session settings
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=true
SESSION_SECURE_COOKIE=true

# Use proper cache driver
CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
```

### Database Security
- Use strong database passwords
- Limit database user permissions
- Use SSL connections for remote databases
- Regular database backups

### HTTPS Configuration
In production, ensure:
- Use HTTPS (SSL/TLS certificates)
- Set `APP_URL` to https://your-domain.com
- Configure web server (Nginx/Apache) for HTTPS

## Performance Optimization

### Production Cache Settings
```bash
# Enable OPcache in PHP
opcache.enable=1
opcache.memory_consumption=128
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=4000

# Laravel optimizations
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

### Frontend Build Optimization
```bash
# Production build
npm run build

# Enable gzip compression in web server
# Enable browser caching for static assets
```

## Backup Strategy

### Database Backups
```bash
# MySQL backup
mysqldump -u username -p database_name > backup.sql

# SQLite backup
cp database.sqlite backup_$(date +%Y%m%d).sqlite
```

### Application Backups
- Code repository (Git)
- Environment files (securely stored)
- User uploaded files
- Database dumps
- Log files (for debugging)

## Monitoring and Logging

### Log Configuration
```bash
LOG_CHANNEL=stack
LOG_LEVEL=error  # debug, info, notice, warning, error, critical
```

### Health Monitoring
- Monitor application uptime
- Database connection health
- Disk space usage
- Memory usage
- Response times

## Deployment Checklist

- [ ] Environment variables configured
- [ ] Database migrations run
- [ ] Application key generated
- [ ] Caches cleared and optimized
- [ ] HTTPS enabled
- [ ] Backup strategy implemented
- [ ] Monitoring configured
- [ ] Security headers configured
- [ ] Error reporting configured
- [ ] Log rotation configured