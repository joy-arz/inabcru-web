@extends('layouts.app')

@section('title', trans_for('publications.title') . ' | InaBCRU')
@section('description', trans_for('publications.subtitle'))

@section('content')
{{-- Hero Section --}}
<section class="pt-40 pb-20 relative overflow-hidden">
  <div class="absolute inset-0">
    <img src="https://images.unsplash.com/photo-1532938911079-1b06ac7ceec7?w=1920&q=80" alt="Publications" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-dark/80"></div>
  </div>
  <div class="relative z-10 max-w-6xl mx-auto px-6 lg:px-8">
    <div class="animate-fade-up opacity-0">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-white/60 mb-4">
        {{ $locale == 'id' ? 'Publikasi' : 'Publications' }}
      </p>
      <h1 class="font-heading text-4xl md:text-5xl font-bold tracking-[-0.02em] mb-4 text-white">
        {{ trans_for('publications.title') }}
      </h1>
      <p class="text-white/70 text-lg max-w-2xl">
        {{ trans_for('publications.subtitle') }}
      </p>
    </div>
  </div>
</section>

{{-- Publications Section --}}
<section class="py-24 bg-background">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    @php
    $publications = [
      ['title' => 'Diversity and Distribution of Fruit Bats in Sulawesi', 'journal' => 'Journal of Bat Research', 'date' => '2024-03-15', 'cover' => 'https://picsum.photos/seed/bat1/800/450'],
      ['title' => $locale == 'id' ? 'KEANEKARAGAMAN KELELAWAR DI TAMAN NASIONAL LORE LINDU' : 'Diversity of Bats in Lore Lindu National Park', 'journal' => 'Indonesian Journal of Conservation', 'date' => '2024-02-20', 'cover' => 'https://picsum.photos/seed/bat2/800/450'],
      ['title' => 'Habitat Preference of Echolocating Bats in Java', 'journal' => 'Biodiversity Journal', 'date' => '2023-11-10', 'cover' => 'https://picsum.photos/seed/bat3/800/450'],
      ['title' => $locale == 'id' ? 'Populasi Kelelawar Penghisap Darah di Kalimantan' : 'Blood-Feeding Bat Population in Kalimantan', 'journal' => 'Veterinary Journal', 'date' => '2023-08-25', 'cover' => 'https://picsum.photos/seed/bat4/800/450'],
      ['title' => 'Conservation Status of Endemic Bats in Papua', 'journal' => 'Endangered Species Research', 'date' => '2023-05-15', 'cover' => 'https://picsum.photos/seed/bat5/800/450'],
      ['title' => $locale == 'id' ? 'Survei Kelelawar di Kawasan Ekosistem Leuser' : 'Bat Survey in Leuser Ecosystem Area', 'journal' => 'Forest Research Journal', 'date' => '2022-12-01', 'cover' => 'https://picsum.photos/seed/bat6/800/450'],
    ];
    @endphp

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      @foreach($publications as $idx => $pub)
        <div class="bg-surface-warm rounded-2xl overflow-hidden border border-border hover:shadow-lg transition-shadow duration-300 animate-fade-up opacity-0" style="animation-delay: {{ ($idx + 1) * 0.1 }}s;">
          <div class="aspect-video overflow-hidden">
            <img src="{{ $pub['cover'] }}" alt="{{ $pub['title'] }}" class="w-full h-full object-cover">
          </div>
          <div class="p-6">
            <p class="text-muted text-xs mb-2">{{ $pub['date'] }}</p>
            <h3 class="font-heading text-lg font-semibold text-text mb-2 line-clamp-2">{{ $pub['title'] }}</h3>
            <p class="text-primary text-sm font-medium">{{ $pub['journal'] }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endsection