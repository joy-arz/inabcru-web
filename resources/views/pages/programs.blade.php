@extends('layouts.public')

@section('title', trans_for('nav.programs', $locale) . ' | InaBCRU')
@section('description', trans_for('programs.subtitle', $locale))

@section('content')
{{-- Hero Section --}}
<section class="pt-40 pb-20 relative overflow-hidden">
  <div class="absolute inset-0">
    <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=1920&q=80" alt="Conservation programs" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-dark/80"></div>
  </div>
  <div class="relative z-10 max-w-6xl mx-auto px-6 lg:px-8">
    <div class="animate-fade-up opacity-0">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-white/60 mb-4">
        {{ $locale == 'id' ? 'Program' : 'Programs' }}
      </p>
      <h1 class="font-heading text-4xl md:text-5xl font-bold tracking-[-0.02em] mb-4 text-white">
        {{ trans_for('programs.title', $locale) }}
      </h1>
      <p class="text-white/70 text-lg max-w-2xl">
        {{ trans_for('programs.subtitle', $locale) }}
      </p>
    </div>
  </div>
</section>

{{-- Programs Grid Section --}}
<section class="py-24 bg-background">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      @php
      $programs = [
        [
          'title' => $locale == 'id' ? 'Survei Populasi Kelelawar' : 'Bat Population Survey',
          'description' => $locale == 'id'
            ? 'Riset lapangan untuk mengidentifikasi, memetakan, dan memantau populasi kelelawar di berbagai habitat di Indonesia.'
            : 'Field research to identify, map, and monitor bat populations across various habitats in Indonesia.',
          'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>'
        ],
        [
          'title' => $locale == 'id' ? 'Monitoring Kesehatan Kelelawar' : 'Bat Health Monitoring',
          'description' => $locale == 'id'
            ? 'Program pemantauan kesehatan kelelawar untuk mendeteksi dini penyakit zoonosis.'
            : 'Bat health monitoring program to detect zoonotic diseases early.',
          'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>'
        ],
        [
          'title' => $locale == 'id' ? 'Edukasi dan Penyuluhan' : 'Education and Outreach',
          'description' => $locale == 'id'
            ? 'Program edukasi untuk meningkatkan kesadaran masyarakat tentang pentingnya kelelawar.'
            : 'Educational programs to raise public awareness about the importance of bats.',
          'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>'
        ],
        [
          'title' => $locale == 'id' ? 'Konservasi Habitat' : 'Habitat Conservation',
          'description' => $locale == 'id'
            ? 'Upaya perlindungan dan restorasi habitat alami kelelawar termasuk gua dan hutan.'
            : 'Efforts to protect and restore natural bat habitats including caves and forests.',
          'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
        ],
        [
          'title' => $locale == 'id' ? 'Pelatihan Penelitian' : 'Research Training',
          'description' => $locale == 'id'
            ? 'Pelatihan metodologi penelitian kelelawar untuk mahasiswa dan peneliti muda.'
            : 'Bat research methodology training for students and young researchers.',
          'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>'
        ],
        [
          'title' => $locale == 'id' ? 'Pengelolaan Data' : 'Data Management',
          'description' => $locale == 'id'
            ? 'Pengelolaan database kelelawar Indonesia untuk mendukung penelitian dan konservasi.'
            : 'Indonesian bat database management to support research and conservation.',
          'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" /></svg>'
        ],
      ];
      @endphp

      @foreach($programs as $idx => $program)
        <div class="bg-surface-warm rounded-2xl p-8 border border-border group hover:shadow-lg transition-shadow duration-300 cursor-pointer animate-fade-up opacity-0" style="animation-delay: {{ ($idx + 1) * 0.1 }}s;">
          <div class="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
            {!! $program['icon'] !!}
          </div>
          <h3 class="font-heading text-xl font-semibold text-text mb-3">
            {{ $program['title'] }}
          </h3>
          <p class="text-muted leading-relaxed">
            {{ $program['description'] }}
          </p>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endsection