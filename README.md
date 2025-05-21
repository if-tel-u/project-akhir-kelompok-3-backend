# jualin-backend

## Requirements

- PHP >= 8.1
- Laravel >= 10
- MySQL or PostgreSQL
- Composer
- (Optional) Laravel Sail or Docker

## Installation

```bash
# Clone the repo
git clone https://github.com/yourusername/used-items-api.git
cd used-items-api

# Install dependencies
composer install

# Copy and configure environment
cp .env.example .env
php artisan key:generate

# Set up database
php artisan migrate --seed

# Run the development server
php artisan serve
