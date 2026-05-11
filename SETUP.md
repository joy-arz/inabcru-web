# InaBCRU Website - Laravel Setup Guide

## Prerequisites

- PHP 8.2+ with extensions: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`
- Composer 2.x
- Node.js 18+ (for asset compilation)
- MySQL 8.0+ database

## Local Development Setup

### 1. Clone & Install Dependencies

```bash
git clone https://github.com/joy-arz/inabcru-web.git
cd inabcru-web/laravel-app
composer install
npm install
```

### 2. Environment Configuration

```bash
cp .env.example .env
```

Edit `.env` with your local database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inabcru
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 3. Generate App Key & Run Migrations

```bash
php artisan key:generate
php artisan migrate
php artisan db:seed  # Optional: seed sample data
```

### 4. Run Development Server

```bash
php artisan serve
```

Visit `http://localhost:8000`

---

## Deployment to Hostinger (Git-based)

### 1. On Your Local Machine

```bash
cd laravel-app
git remote set-url origin https://github.com/joy-arz/inabcru-web.git
git add .
git commit -m "Your commit message"
git push origin main
```

### 2. On Hostinger (SSH Terminal)

```bash
# Navigate to your domain's public_html or document root
cd ~/public_html

# Clone the repository (or pull if already cloned)
git clone https://github.com/joy-arz/inabcru-web.git .
# OR if already cloned:
# git pull origin main

# Install dependencies (run in domain root, NOT public_html)
cd ~/laravel-app  # or wherever you cloned
composer install --no-dev --optimize-autoloader

# Run migrations
php artisan migrate --force

# Clear and cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set correct permissions
chmod -R 755 storage bootstrap/cache
chown -R youruser:youruser .
```

### 3. Configure .env on Hostinger

Edit `~/.env` (or wherever your .env is) with Hostinger MySQL credentials:

```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

APP_URL=https://yourdomain.com
```

### 4. Initial Setup (First Time)

Visit: `https://yourdomain.com/setup`

This will:
- Run fresh migrations
- Seed admin user, stats, publications, articles, team members

**IMPORTANT: Delete the `/setup` route after first run!**

```bash
# Remove setup route from routes/web.php
# Then:
git commit -m "Remove setup route"
git push origin main
```

---

## Hostinger Directory Structure

```
home/
├── inabcru-web/          # Git clone location (private)
│   ├── laravel-app/      # Laravel application
│   │   ├── app/
│   │   ├── public/       # ← public_html should point here
│   │   ├── storage/
│   │   └── ...
│   └── vendor/
└── public_html/          # Symlink or alias to laravel-app/public
```

### Configure public_html as symlink:

```bash
cd ~/public_html
rm -rf public_html
ln -s ~/inabcru-web/laravel-app/public ~/public_html
```

---

## Admin Panel Access

- URL: `https://yourdomain.com/admin`
- Username: `admin`
- Password: `password123`

---

## Useful Commands

```bash
php artisan route:list          # List all routes
php artisan migrate:fresh       # Fresh migration (destructive!)
php artisan db:seed             # Seed database
php artisan config:cache        # Cache config
php artisan view:cache          # Cache views
php artisan route:cache         # Cache routes
php artisan optimize            # Production optimizations
```

---

## Troubleshooting

### Permission Denied on Storage
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 500 Error after Deployment
- Check `.env` exists and has correct DB credentials
- Run `php artisan config:cache`
- Check `storage/logs/` for error details

### Clear All Caches
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
composer dump-autoload
```