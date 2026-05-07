-- InaBCRU Database Seed Data
-- Run this AFTER importing 001_schema.sql

-- To generate password hash, run this PHP command:
-- php -r "echo password_hash('admin123', PASSWORD_BCRYPT, ['cost' => 12]);"

-- Seed admin user (replace HASH with actual hash from above command)
INSERT INTO admin_users (id, email, password_hash) VALUES
  ('00000000-0000-0000-0000-000000000001', 'admin@inabcru.org', 'PLACEHOLDER_HASH_REPLACE_WITH_REAL')
ON DUPLICATE KEY UPDATE email = email;

-- Seed impact stats (example data)
INSERT INTO impact_stats (id, label_id, label_en, value, unit, display_order) VALUES
  (UUID(), 'Spesies Disurvei', 'Species Surveyed', '45', '+', 1),
  (UUID(), 'Lokasi Riset', 'Research Sites', '12', '', 2),
  (UUID(), 'Publikasi Ilmiah', 'Publications', '28', '', 3),
  (UUID(), 'Anggota Aktif', 'Active Members', '35', '', 4)
ON DUPLICATE KEY UPDATE email = email;
