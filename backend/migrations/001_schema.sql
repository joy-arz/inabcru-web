-- InaBCRU Database Schema
-- For Hostinger MariaDB

CREATE TABLE IF NOT EXISTS publications (
  id CHAR(36) PRIMARY KEY,
  title_id TEXT NOT NULL,
  title_en TEXT NOT NULL,
  journal TEXT,
  year INT,
  doi TEXT,
  abstract_id TEXT,
  abstract_en TEXT,
  content_blocks JSON NOT NULL DEFAULT '[]',
  cover_image_url TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS articles (
  id CHAR(36) PRIMARY KEY,
  title_id TEXT NOT NULL,
  title_en TEXT NOT NULL,
  slug TEXT UNIQUE NOT NULL,
  blocks_id JSON,
  blocks_en JSON,
  cover_image_url TEXT,
  meta_location_id TEXT,
  meta_location_en TEXT,
  published_at TIMESTAMP,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS team_members (
  id CHAR(36) PRIMARY KEY,
  name TEXT NOT NULL,
  title_id TEXT,
  title_en TEXT,
  photo_url TEXT,
  bio_id TEXT,
  bio_en TEXT,
  linkedin_url TEXT,
  display_order INT DEFAULT 0
);

CREATE TABLE IF NOT EXISTS impact_stats (
  id CHAR(36) PRIMARY KEY,
  label_id TEXT NOT NULL,
  label_en TEXT NOT NULL,
  value TEXT NOT NULL,
  unit TEXT,
  display_order INT DEFAULT 0
);

CREATE TABLE IF NOT EXISTS admin_users (
  id CHAR(36) PRIMARY KEY,
  email TEXT UNIQUE NOT NULL,
  password_hash TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS contact_submissions (
  id CHAR(36) PRIMARY KEY,
  name TEXT NOT NULL,
  email TEXT NOT NULL,
  message TEXT NOT NULL,
  submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  ip_address TEXT
);

CREATE INDEX IF NOT EXISTS idx_articles_slug ON articles(slug);
CREATE INDEX IF NOT EXISTS idx_publications_year ON publications(year);
CREATE INDEX IF NOT EXISTS idx_team_members_display_order ON team_members(display_order);
CREATE INDEX IF NOT EXISTS idx_impact_stats_display_order ON impact_stats(display_order);

-- Seed admin user (password: admin123)
-- Change this after first login!
INSERT INTO admin_users (id, email, password_hash) VALUES
  ('00000000-0000-0000-0000-000000000001', 'admin@inabcru.org', '$2y$12$LQv3c1yqBWVHxkd0LHAkCOYz6TtxMQJqhN8/X4r0m5YbXq2z1K4aC')
ON DUPLICATE KEY UPDATE email = email;
