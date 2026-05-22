# InaBCRU Website Changes TODO

## Overview
This document tracks the approved editorial changes for the InaBCRU website. Read this file if session is compacted.

## Status: COMPLETED

### 1. Navigation menu ✅
- [x] Reorder nav: Beranda, Tentang, Program, Berita, Arsip (replaces Publikasi), Mitra (new), Kontak, Dukungan (dropdown with Keanggotaan + Donasi sub-items)
- [x] Remove "Dampak" entirely
- [x] Remove standalone Donasi button from header
- [x] Donasi hidden in frontend (visible only in admin via $donationEnabled flag)
- [x] Updated routes/web.php for new nav structure

### 2. Global/Footer ✅
- [x] Fix copyright: "Indonesia Bat Conservation Research Union" → "Indonesian Bat Conservation Research Union"
- [x] Enlarge top-left nav logo (horizontal variant: InaBCRU_LOGO CERAH HORIZONTAL.webp)
- [x] Footer: Remove "Tautan Cepat" and "Sumber Daya" columns
- [x] Updated tagline in lang files

### 3. Home page ✅
- [x] Fix org name in hero to "Indonesian Bat Conservation Research Union"
- [x] Remove secondary text logo below main org name
- [x] Replace hero static image with looping muted video (bat cave footage placeholder at /videos/bat-cave-exit.mp4)
- [x] Remove scrolling partner logo ticker section
- [x] Remove: Dampak Kami, Program Kami, Tentang Kami, Berita Terbaru, Donasi Sekarang sections
- [x] Home page = hero + nav only

### 4. About page (Tentang) ✅
- [x] Remove "TENTANG KAMI" large uppercase heading (was removed from structure)
- [x] Update intro via lang files
- [x] Remove "Prinsip Yang Memandu Kami" section (4 cards)
- [x] Remove "Bergabung dengan Tim Kami" section
- [x] Team section major restructure:
  - [x] Group members by division in this order: Executive Board, Divisi Riset, Divisi Konservasi, Divisi Pendidikan & Pelatihan, Database & Data Sains, Dewan Pengawas, Students & Voluntary
  - [x] Click card → inline expand bio below (not modal)
  - [x] Only show divisions that have members
  - [x] Admin: Add Division dropdown, Bio field, Role field

### 5. Mitra / Partners page ✅
- [x] New public page at /mitra (ID) and /en/mitra (EN)
- [x] Page title: "Mitra InaBCRU" / "InaBCRU Partners"
- [x] Intro via lang files
- [x] Grid of partner cards: logo, name, description
- [x] Placeholder state if no partners
- [x] Admin CRUD updated with: active toggle, description field

### 6. Migrations ✅
- [x] Add division, role, bio to team_members table
- [x] Add active, description to partners table

---

## Division list for team members (in order)
1. Executive Board (Ketua/Director, Sekretaris Eksekutif/Executive Secretary, Bendahara/Finance)
2. Divisi Riset (Research Division) - Chief of Research, Members
3. Divisi Konservasi (Conservation Division) - Chief of Conservation, Members
4. Divisi Pendidikan & Pelatihan (Education and Capacity Building Division) - Chief of Education and Capacity Building, Members
5. Database & Data Sains (Database & Data Science)
6. Dewan Pengawas (Supervisory Board)
7. Students & Voluntary

## Partner admin fields
- Logo (image upload)
- Name
- Description (textarea)
- Display order (integer)
- Active toggle (show/hide)

## Files Modified

### Layouts
- resources/views/layouts/navbar.blade.php - new nav structure with dropdown
- resources/views/layouts/footer.blade.php - removed columns, enlarged logo

### Pages
- resources/views/pages/home.blade.php - stripped to hero only
- resources/views/pages/about-us.blade.php - restructured team with divisions
- resources/views/pages/mitra.blade.php - NEW partner page

### Admin Views
- resources/views/admin/team/form.blade.php - added division, role, bio fields
- resources/views/admin/team/index.blade.php - grouped by division
- resources/views/admin/partners/form.blade.php - added active toggle, description
- resources/views/admin/partners/index.blade.php - kept existing

### Controllers
- app/Http/Controllers/Admin/TeamController.php - added division, role, bio
- app/Http/Controllers/Admin/PartnerController.php - added active, description

### Models
- app/Models/TeamMember.php - added division, role, bio fields
- app/Models/Partner.php - added active, description fields

### Migrations (new files)
- database/migrations/2025_05_22_000001_add_division_role_bio_to_team_members_table.php
- database/migrations/2025_05_22_000002_add_description_active_to_partners_table.php

### Lang Files
- resources/lang/id.json - updated nav, footer tagline, about, mitra
- resources/lang/en.json - updated nav, footer tagline, about, mitra

### Routes
- routes/web.php - removed impact from validPages, added mitra route, simplified home route

### TODO
- TODO.md (this file)

## Remaining
- Video file: Place a video at public/videos/bat-cave-exit.mp4 for the hero background
- Donor visibility: Currently $donationEnabled is hardcoded to false - change to true when ready to show Donate menu item