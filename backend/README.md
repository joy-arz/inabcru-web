# InaBCRU PHP Backend

PHP backend API for InaBCRU website, designed for Hostinger Web Hosting.

## Structure

```
backend-php/
├── public/
│   ├── index.php          # Entry point with routing
│   └── api/
│       ├── articles.php       # Public articles API
│       ├── publications.php   # Public publications API
│       ├── team.php           # Public team API
│       ├── stats.php          # Public stats API
│       ├── contact.php        # Public contact API
│       ├── youtube.php        # Public youtube API
│       ├── auth.php           # Login/auth API
│       └── admin/
│           ├── articles.php   # Admin articles CRUD
│           ├── team.php       # Admin team CRUD
│           ├── stats.php      # Admin stats CRUD
│           ├── publications.php # Admin publications CRUD
│           └── upload.php     # File upload API
├── includes/
│   ├── config.php         # Configuration
│   ├── database.php       # PDO database connection
│   └── auth.php           # JWT authentication
├── migrations/
│   └── 001_schema.sql     # Database schema
├── uploads/               # Uploaded files (auto-created)
├── .htaccess              # URL routing rules
└── composer.json          # Dependencies
```

## Setup on Hostinger

### 1. Database Setup

1. Log into **hPanel** → **Databases**
2. Create a new MySQL/MariaDB database
3. Note the hostname, database name, username, password

### 2. Run Migration

1. Go to **hPanel** → **phpMyAdmin**
2. Select your database
3. Go to **Import** tab
4. Upload `migrations/001_schema.sql`

### 3. Update Configuration

Create environment file or update `includes/config.php` with your database credentials:

```php
define('DB_HOST', 'your_hostname');
define('DB_NAME', 'your_database');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('JWT_SECRET', 'your-secret-key-min-32-chars');
define('UPLOAD_URL', 'https://yourdomain.com/backend-php/uploads');
```

### 4. Upload Files

1. Upload the entire `backend-php` folder to your Hostinger public_html
2. Set permissions: `chmod 755 uploads`

### 5. Create Admin User

In phpMyAdmin, run this SQL (or use the seeded one):

```sql
INSERT INTO admin_users (id, email, password_hash) VALUES
  ('00000000-0000-0000-0000-000000000001', 'admin@yourdomain.com', '$2y$12$YOUR_HASH');
```

To generate a password hash, create a simple PHP script:

```php
<?php echo password_hash('your-password', PASSWORD_BCRYPT, ['cost' => 12]);
```

## API Endpoints

### Public Routes (no auth required)

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/publications` | List all publications |
| GET | `/api/publications/:id` | Get publication by ID |
| GET | `/api/articles` | List all articles |
| GET | `/api/articles/slug/:slug` | Get article by slug |
| GET | `/api/team` | List team members |
| GET | `/api/stats` | List impact stats |
| POST | `/api/contact` | Submit contact form |
| POST | `/api/login` | Admin login |

### Admin Routes (JWT required)

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/articles` | List articles |
| POST | `/api/articles` | Create article |
| GET | `/api/articles/:id` | Get article |
| PUT | `/api/articles/:id` | Update article |
| DELETE | `/api/articles/:id` | Delete article |
| GET | `/api/team` | List team members |
| POST | `/api/team` | Create team member |
| PUT | `/api/team` | Bulk update order |
| GET | `/api/team/:id` | Get team member |
| PUT | `/api/team/:id` | Update team member |
| DELETE | `/api/team/:id` | Delete team member |
| GET | `/api/stats` | List stats |
| POST | `/api/stats` | Create stat |
| PUT | `/api/stats` | Bulk update |
| GET | `/api/stats/:id` | Get stat |
| PUT | `/api/stats/:id` | Update stat |
| DELETE | `/api/stats/:id` | Delete stat |
| POST | `/api/upload` | Upload file |

### Authentication

Admin endpoints require JWT token in Authorization header:

```
Authorization: Bearer <token>
```

## Frontend Integration

Update `frontend/.env.local`:

```env
NEXT_PUBLIC_API_URL=https://yourdomain.com/backend-php/api
```

## Default Admin Credentials

The seeded admin user (change immediately after first login):
- Email: `admin@inabcru.org`
- Password: `admin123` (SEED HASH - NOT SECURE - CHANGE THIS!)

## Troubleshooting

### CORS Errors
Make sure the frontend URL is allowed in `includes/config.php` `$allowed_origins` array.

### Database Connection Failed
1. Check hostname (try `localhost` instead of `127.0.0.1`)
2. Verify database credentials
3. Ensure user has permissions

### Upload Fails
1. Check `uploads/` directory exists and is writable (chmod 755)
2. Verify PHP upload limits in .htaccess
