# Hotel Management

## Docker Development Setup

This project includes both development and production Docker configurations. The development setup includes live code reloading and persistent vendor dependencies.

### Development Environment

1. Build and start the development environment:
```bash
docker compose up --build
```

The development environment includes:
- Live code reloading through volume mounting
- Persistent vendor directory
- Mailhog for email testing (http://localhost:8025)
- MySQL database with persistence
- PHP configuration through mounted php.ini

### Production Environment

For production deployment:

1. Build the production image:
```bash
docker build -f Dockerfile.prod -t hotel-app:prod .
```

2. Run the production container:
```bash
docker compose -f docker-compose.prod.yml up -d
```

### Key Differences

Development Setup:
- Uses Dockerfile.dev with mounted volumes for live code changes
- Keeps vendor directory in a named volume
- Includes development tools and configurations
- Environment variables defaulted for easy setup

Production Setup:
- Uses multi-stage builds for smaller image size
- Performs fresh composer install during build
- Optimized autoloader
- No mounted volumes for better security
- Requires proper environment variables

### Environment Variables

Create a `.env` file with these variables:
```
DB_HOST=db
DB_USER=your_user
DB_PASS=your_password
DB_NAME=hotel_app
DB_ROOT_PASS=root_password
ENVIRONMENT=development
```

### Accessing Services

- Website: http://localhost
- Database: localhost:3306
- Mail Testing UI: http://localhost:8025
