# Invoicing API

Multi-tenant invoicing application built with Laravel 12 and Livewire 3.

## Features

- Tenant registration and authentication
- Tenant-scoped invoices
- Credit-based invoice creation (1 credit per invoice)
- Razorpay-based wallet top-up flow
- Async PDF generation for invoices (queued job + Browsershot)
- S3 storage support for generated invoice PDFs

## Tech Stack

- PHP 8.2+
- Laravel 12
- Livewire 3
- MySQL
- Queue worker (database queue driver by default)
- Razorpay SDK
- Puppeteer + Browsershot (for PDF generation)

## Prerequisites

Make sure these are installed locally:

- PHP 8.2+
- Composer
- Node.js + npm
- MySQL
- Google Chrome/Chromium (required by Browsershot/Puppeteer)

## Setup

1. Clone the repository.
2. Install dependencies:

```bash
composer install
npm install
```

3. Create environment file:

```bash
cp .env.example .env
```

PowerShell alternative:

```powershell
Copy-Item .env.example .env
```

4. Generate app key:

```bash
php artisan key:generate
```

5. Configure `.env` values (see important variables below).
6. Run migrations:

```bash
php artisan migrate
```

7. Start the app:

```bash
composer run dev
```

This runs:

- Laravel dev server
- Queue listener
- Vite dev server

## Important Environment Variables

Add these to `.env` as needed:

```dotenv
APP_NAME="Invoicing API"
APP_ENV=local
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=invoicing_api
DB_USERNAME=root
DB_PASSWORD=

QUEUE_CONNECTION=database

RAZORPAY_KEY=your_razorpay_key
RAZORPAY_SECRET=your_razorpay_secret

FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=your_aws_key
AWS_SECRET_ACCESS_KEY=your_aws_secret
AWS_DEFAULT_REGION=ap-south-1
AWS_BUCKET=your_bucket
AWS_URL=
AWS_ENDPOINT=
```

Notes:

- `RAZORPAY_KEY` and `RAZORPAY_SECRET` are required for credit top-ups.
- Invoice PDFs are uploaded using the `s3` disk in the current implementation.

## Local Routes (Web)

- `GET /` - Landing page
- `GET /register` - Tenant registration
- `GET /login` - Login
- `GET /dashboard` - Tenant dashboard (auth + tenant middleware)
- `GET /invoices` - Invoice list
- `GET /invoices/create` - Create invoice
- `GET /credits` - Top-up credits and transaction history

## Testing

Run tests with:

```bash
composer test
```

Or:

```bash
php artisan test
```

## Useful Commands

```bash
php artisan queue:listen --tries=1
php artisan queue:work
npm run dev
npm run build
vendor/bin/pint
vendor/bin/rector
```

## License

This project is open-source and available under the [MIT license](https://opensource.org/licenses/MIT).
