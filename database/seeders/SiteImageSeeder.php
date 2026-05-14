<?php

namespace Database\Seeders;

use App\Models\SiteImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SiteImageSeeder extends Seeder
{
    public function run(): void
    {
        $slots = [
            // Logo images
            ['key' => 'logo_light', 'location' => 'layouts.navbar', 'category' => 'Logo', 'image_url' => '/images/Logo/InaBCRU_LOGO CERAH.webp', 'alt_text' => 'InaBCRU Logo (Light)', 'usage' => 'Navbar logo on dark backgrounds'],
            ['key' => 'logo_dark', 'location' => 'layouts.footer', 'category' => 'Logo', 'image_url' => '/images/Logo/InaBCRU_LOGO GELAP A.webp', 'alt_text' => 'InaBCRU Logo (Dark)', 'usage' => 'Footer logo and navbar on light backgrounds'],

            // Hero backgrounds
            ['key' => 'hero_home', 'location' => 'pages.home', 'category' => 'Hero', 'image_url' => '/images/Field activity/IMG_9975.webp', 'alt_text' => 'Bat in natural habitat', 'usage' => 'Homepage hero background'],
            ['key' => 'hero_donate', 'location' => 'pages.donate', 'category' => 'Hero', 'image_url' => '/images/Field activity/IMG_2209.webp', 'alt_text' => 'Conservation effort', 'usage' => 'Donate page hero'],
            ['key' => 'hero_news', 'location' => 'pages.news', 'category' => 'Hero', 'image_url' => '/images/Field activity/IMG_0909.webp', 'alt_text' => 'News and updates', 'usage' => 'News page hero'],
            ['key' => 'hero_about_us', 'location' => 'pages.about-us', 'category' => 'Hero', 'image_url' => '/images/Field activity/IMG_2175.webp', 'alt_text' => 'Indonesian forest landscape', 'usage' => 'About Us page hero'],
            ['key' => 'hero_programs', 'location' => 'pages.programs', 'category' => 'Hero', 'image_url' => '/images/Field activity/IMG_2226.webp', 'alt_text' => 'Conservation programs', 'usage' => 'Programs page hero'],
            ['key' => 'hero_impact', 'location' => 'pages.impact', 'category' => 'Hero', 'image_url' => '/images/Field activity/IMG_4469.webp', 'alt_text' => 'Our impact', 'usage' => 'Impact page hero'],
            ['key' => 'hero_contact', 'location' => 'pages.contact', 'category' => 'Hero', 'image_url' => '/images/Field activity/IMG_2212.webp', 'alt_text' => 'Contact us', 'usage' => 'Contact page hero'],
            ['key' => 'hero_vision_mission', 'location' => 'pages.vision-mission', 'category' => 'Hero', 'image_url' => '/images/Field activity/IMG_2548.webp', 'alt_text' => 'Our vision', 'usage' => 'Vision & Mission page hero'],
            ['key' => 'hero_team', 'location' => 'pages.team', 'category' => 'Hero', 'image_url' => '/images/Field activity/IMG_2214.webp', 'alt_text' => 'Research team in field', 'usage' => 'Team page hero'],
            ['key' => 'hero_publications', 'location' => 'pages.publications', 'category' => 'Hero', 'image_url' => '/images/Field activity/IMG_6290.webp', 'alt_text' => 'Publications', 'usage' => 'Publications page hero'],
            ['key' => 'hero_news_detail', 'location' => 'pages.news-detail', 'category' => 'Hero', 'image_url' => '/images/Field activity/IMG_0909.webp', 'alt_text' => 'News article', 'usage' => 'News detail page hero'],

            // About page specific images
            ['key' => 'about_section_team', 'location' => 'pages.about-us', 'category' => 'About', 'image_url' => '/images/Field activity/IMG_6290.webp', 'alt_text' => 'Bat research in field', 'usage' => 'About Us team section'],

            // Donate CTA section
            ['key' => 'donate_cta_background', 'location' => 'pages.home', 'category' => 'Sections', 'image_url' => '/images/Field activity/IMG_9975.webp', 'alt_text' => 'Bat conservation', 'usage' => 'Donate CTA section background (homepage)'],

            // About section on homepage
            ['key' => 'home_about_background', 'location' => 'pages.home', 'category' => 'Sections', 'image_url' => 'https://images.pexels.com/photos/1682705/pexels-photo-1682705.jpeg?auto=compress&cs=tinysrgb&w=1920', 'alt_text' => 'Bat conservation', 'usage' => 'About section background on homepage'],
        ];

        foreach ($slots as $slot) {
            SiteImage::updateOrCreate(
                ['key' => $slot['key']],
                $slot
            );
        }
    }
}