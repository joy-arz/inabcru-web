<?php
define('API_BASE_URL', 'https://inabcru.org/backend/api');
define('BASE_URL', 'https://inabcru.org');

define('PRIMARY_COLOR', '#2B3984');
define('CTA_COLOR', '#F97316');

$navItems = [
  ['href' => BASE_URL . '/', 'label' => 'Home'],
  ['href' => BASE_URL . '/about', 'label' => 'About'],
  ['href' => BASE_URL . '/team', 'label' => 'Team'],
  ['href' => BASE_URL . '/publications', 'label' => 'Publications'],
  ['href' => BASE_URL . '/donate', 'label' => 'Donate'],
];

$messages = [
  'nav' => [
    'home' => 'Home',
    'about' => 'About',
    'team' => 'Team',
    'publications' => 'Publications',
    'donate' => 'Donate',
  ],
  'footer' => [
    'tagline' => 'Protecting bats to maintain Indonesia\'s ecosystem balance',
    'quickLinks' => 'Quick Links',
    'contactInfo' => 'Contact Info',
    'email' => 'Email',
    'founded' => 'Founded',
    'legalId' => 'AHU-0009178.AH.01.07.TAHUN 2025',
    'rights' => 'All rights reserved'
  ]
];