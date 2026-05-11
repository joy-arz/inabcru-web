# InaBCRU Deployment Guide for Hostinger

## Prerequisites
- Hostinger account with PHP 8.1+ hosting
- SSH access (optional but recommended)
- FileZilla or Hostinger File Manager

---

## Step 1: Create MySQL Database on Hostinger

1. Go to **Dashboard → Database → MySQL Databases**
2. Create a new database (e.g., `inabcru_db`)
3. Create a user and assign all privileges
4. Note down: host, database name, username, password

---

## Step 2: Configure .env

1. Copy `.env.example` to `.env`
2. Update with your Hostinger database credentials:

```env
DB_HOST=localhost
DB_DATABASE=inabcru_db
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

3. Generate app key (if not present):
   ```
   php artisan key:generate
   ```

---

## Step 3: Upload Laravel Files

### Option A: Direct Upload (Shared Hosting)
1. Zip `laravel-app` folder
2. Upload to `/public_html/` via File Manager
3. Extract
4. Move contents so `public_html/public` becomes `public_html/`

### Option B: Subdomain Setup (Recommended)
1. Create subdomain `inabcru.yourdomain.com`
2. Point document root to `laravel-app/public/`
3. Upload directly, no file moving needed

---

## Step 4: Set Document Root (Shared Hosting)

If using `/public_html` directly:
1. Move all files from `public_html/laravel-app/public/*` to `public_html/`
2. Move `public_html/laravel-app/.env` to `public_html/`
3. Edit `public/index.php`:

```php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle($request = Illuminate\Http\Request::capture());
$response->send();
$kernel->terminate($middleware, $response);
```

---

## Step 5: Run Setup

1. Visit `https://yourdomain.com/setup`
2. Login with admin credentials:
   - Username: `admin`
   - Password: `password123`
3. Wait for "Setup complete!"
4. **DELETE THE /setup ROUTE from web.php IMMEDIATELY**

---

## Admin Access

- URL: `https://yourdomain.com/admin/login`
- Username: `admin`
- Password: `password123`

---

## Troubleshooting

### 500 Internal Server Error
- Check `.env` is present and correct
- Run `php artisan cache:clear`
- Check PHP version (needs 8.1+)

### Database Connection Error
- Verify MySQL credentials in `.env`
- Check if database user has proper privileges

### Class 'PDO' Not Found
- Enable PDO extension in PHP settings on Hostinger

### Route Not Found
- Run `php artisan route:clear`
- Check `.env` APP_URL matches your domain

---

## Delete Setup Route (IMPORTANT)

After setup completes, edit `routes/web.php` and remove the `/setup` route block for security.

---

## File Structure After Upload

```
/public_html/
  ├── app/
  ├── bootstrap/
  ├── config/
  ├── database/
  ├── public/           ← merged into root
  ├── resources/
  ├── routes/
  ├── storage/
  ├── vendor/
  ├── .env
  └── index.php
```

---

## Sample Data Included

After `/setup` runs:
- 2 Publications
- 3 Articles (news)
- 6 Team members
- 4 Impact stats
- 1 Admin user