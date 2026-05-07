@extends('layouts.app')

@section('title', trans_for('metadata.title'))
@section('description', trans_for('metadata.description'))

@section('content')
{{-- Hero Section --}}
<section class="relative min-h-[100svh] flex items-center justify-center overflow-hidden">
  <div class="absolute inset-0">
    <img src="https://images.unsplash.com/photo-1548777123-e216912df7d8?w=1920&q=80" alt="Bat in natural habitat" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-dark/75"></div>
    <div class="absolute inset-0">
      <div class="absolute inset-0 bg-gradient-to-br from-primary/30 via-transparent to-primary/10"></div>
    </div>
  </div>

  <div class="relative z-10 max-w-6xl mx-auto px-6 lg:px-8 text-center">
    <div class="animate-fade-up opacity-0">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-white/60 mb-6">
        {{ $locale == 'id' ? 'Indonesia Bat Conservation Research Union' : 'Conservation Research Union' }}
      </p>
      <h1 class="font-heading text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
        {{ trans_for('home.hero.title') }}
      </h1>
      <p class="text-lg md:text-xl text-white/70 mb-10 max-w-2xl mx-auto">
        {{ trans_for('home.hero.subtitle') }}
      </p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="/{{ $locale }}/donate">
          <button class="px-8 py-4 bg-cta text-white font-semibold rounded-xl hover:bg-cta/90 transition-all duration-200 cursor-pointer">
            {{ trans_for('home.hero.cta') }}
          </button>
        </a>
        <a href="/{{ $locale }}/about">
          <button class="px-8 py-4 border-2 border-white/30 text-white font-semibold rounded-xl hover:bg-white/10 transition-all duration-200 cursor-pointer">
            {{ trans_for('nav.about') }}
          </button>
        </a>
      </div>
    </div>
  </div>

  <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-background to-transparent"></div>
</section>

{{-- Logo Marquee --}}
<section class="py-10 overflow-hidden bg-surface-warm border-y border-border">
  <div class="flex animate-marquee-logos">
    @php
    $partners = [
      ['name' => 'BRIN', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/3/3f/Main_Logo_of_National_Research_and_Innovation_Agency_of_Indonesia.svg'],
      ['name' => 'UGM', 'logo' => 'https://upload.wikimedia.org/wikipedia/id/9/9f/Emblem_of_Universitas_Gadjah_Mada.svg'],
      ['name' => 'ITB', 'logo' => 'https://upload.wikimedia.org/wikipedia/id/9/95/Logo_Institut_Teknologi_Bandung.png'],
      ['name' => 'IPB', 'logo' => 'https://upload.wikimedia.org/wikipedia/id/0/0f/Logo_IPB.png'],
      ['name' => 'Unpad', 'logo' => 'https://upload.wikimedia.org/wikipedia/id/8/80/Lambang_Universitas_Padjadjaran.svg'],
      ['name' => 'UNAIR', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/Logo-Branding-UNAIR-biru.png/250px-Logo-Branding-UNAIR-biru.png'],
      ['name' => 'UPI', 'logo' => 'https://upload.wikimedia.org/wikipedia/id/0/09/Logo_Almamater_UPI.svg'],
      ['name' => 'LIPI', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/b/b5/Logo_LIPI_%282018%29.svg'],
    ];
    $allPartners = array_merge($partners, $partners);
    @endphp
    @foreach($allPartners as $partner)
      <div class="flex-shrink-0 mx-12 flex items-center justify-center">
        <div class="relative h-14 w-44 cursor-pointer">
          <img src="{{ $partner['logo'] }}" alt="{{ $partner['name'] }}" class="h-full w-full object-contain" style="filter: grayscale(100%); opacity: 0.7;" onerror="this.parentElement.style.display='none'">
        </div>
      </div>
    @endforeach
  </div>
</section>

{{-- Stats Section --}}
<section class="py-24 bg-background">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="text-center mb-16 animate-fade-up opacity-0">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-primary mb-4">
        {{ $locale == 'id' ? 'Dampak Kami' : 'Our Impact' }}
      </p>
      <h2 class="font-heading text-3xl md:text-4xl font-bold tracking-[-0.02em] text-text mb-4">
        {{ trans_for('home.stats.title') }}
      </h2>
      <p class="text-muted max-w-xl mx-auto">
        {{ trans_for('home.mission.description') }}
      </p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-6">
      <div class="text-center animate-fade-up opacity-0" style="animation-delay: 0.1s;">
        <div class="font-heading text-4xl md:text-5xl font-bold text-primary mb-2">45+</div>
        <div class="text-muted text-sm font-medium">{{ trans_for('home.stats.speciesSurveyed') }}</div>
      </div>
      <div class="text-center animate-fade-up opacity-0" style="animation-delay: 0.2s;">
        <div class="font-heading text-4xl md:text-5xl font-bold text-primary mb-2">12</div>
        <div class="text-muted text-sm font-medium">{{ trans_for('home.stats.researchLocations') }}</div>
      </div>
      <div class="text-center animate-fade-up opacity-0" style="animation-delay: 0.3s;">
        <div class="font-heading text-4xl md:text-5xl font-bold text-primary mb-2">28</div>
        <div class="text-muted text-sm font-medium">{{ trans_for('home.stats.scientificPublications') }}</div>
      </div>
      <div class="text-center animate-fade-up opacity-0" style="animation-delay: 0.4s;">
        <div class="font-heading text-4xl md:text-5xl font-bold text-primary mb-2">35</div>
        <div class="text-muted text-sm font-medium">{{ trans_for('home.stats.activeMembers') }}</div>
      </div>
    </div>
  </div>
</section>

{{-- Programs Section --}}
<section class="py-24 bg-surface-warm">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="text-center mb-16 animate-fade-up opacity-0">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-primary mb-4">
        {{ $locale == 'id' ? 'Program Kami' : 'Our Programs' }}
      </p>
      <h2 class="font-heading text-3xl md:text-4xl font-bold tracking-[-0.02em] text-text">
        {{ trans_for('home.programs.title') }}
      </h2>
    </div>

    <div class="grid md:grid-cols-3 gap-6 md:gap-8">
      <div class="bg-background rounded-2xl p-8 border border-border hover:shadow-lg transition-shadow duration-300 animate-fade-up opacity-0" style="animation-delay: 0.1s;">
        <div class="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center text-primary mb-6">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </div>
        <h3 class="font-heading text-xl font-semibold text-text mb-3">
          {{ $locale == 'id' ? 'Survei Kelelawar' : 'Bat Survey' }}
        </h3>
        <p class="text-muted leading-relaxed">
          {{ $locale == 'id' ? 'Riset lapangan untuk mengidentifikasi dan memetakan populasi kelelawar di berbagai habitat.' : 'Field research to identify and map bat populations across various habitats.' }}
        </p>
      </div>

      <div class="bg-background rounded-2xl p-8 border border-border hover:shadow-lg transition-shadow duration-300 animate-fade-up opacity-0" style="animation-delay: 0.2s;">
        <div class="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center text-primary mb-6">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
          </svg>
        </div>
        <h3 class="font-heading text-xl font-semibold text-text mb-3">
          {{ $locale == 'id' ? 'Edukasi & Pelatihan' : 'Education & Training' }}
        </h3>
        <p class="text-muted leading-relaxed">
          {{ $locale == 'id' ? 'Program edukasi untuk meningkatkan kesadaran tentang pentingnya kelelawar.' : 'Educational programs to raise awareness about the importance of bats.' }}
        </p>
      </div>

      <div class="bg-background rounded-2xl p-8 border border-border hover:shadow-lg transition-shadow duration-300 animate-fade-up opacity-0" style="animation-delay: 0.3s;">
        <div class="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center text-primary mb-6">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
        <h3 class="font-heading text-xl font-semibold text-text mb-3">
          {{ $locale == 'id' ? 'Konservasi Habitat' : 'Habitat Conservation' }}
        </h3>
        <p class="text-muted leading-relaxed">
          {{ $locale == 'id' ? 'Upaya perlindungan habitat alami kelelawar untuk menjaga keseimbangan ekosistem.' : 'Efforts to protect natural bat habitats to maintain ecosystem balance.' }}
        </p>
      </div>
    </div>
  </div>
</section>

{{-- About Section --}}
<section class="py-24 bg-dark text-white relative overflow-hidden">
  <div class="absolute inset-0">
    <img src="https://images.pexels.com/photos/1682705/pexels-photo-1682705.jpeg?auto=compress&cs=tinysrgb&w=1920" alt="Bat conservation" class="w-full h-full object-cover opacity-20" style="position: absolute; top: 0; left: 0; transform: translateZ(-1px);">
  </div>

  <div class="relative z-10 max-w-6xl mx-auto px-6 lg:px-8">
    <div class="grid md:grid-cols-2 gap-12 items-center">
      <div class="animate-fade-up opacity-0">
        <p class="text-xs font-semibold uppercase tracking-[0.12em] text-white/60 mb-4">
          {{ $locale == 'id' ? 'Tentang Kami' : 'About Us' }}
        </p>
        <h2 class="font-heading text-3xl md:text-4xl font-bold tracking-[-0.02em] mb-6">
          {{ $locale == 'id' ? 'Melindungi Kelelawar Indonesia' : 'Protecting Indonesian Bats' }}
        </h2>
        <p class="text-white/70 leading-relaxed mb-8">
          {{ $locale == 'id'
            ? 'InaBCRU adalah organisasi non-profit yang dedicated untuk konservasi kelelawar di Indonesia melalui penelitian ilmiah, edukasi masyarakat, dan kolaborasi dengan berbagai institusi.'
            : 'InaBCRU is a non-profit organization dedicated to bat conservation in Indonesia through scientific research, public education, and collaboration with various institutions.'
          }}
        </p>
        <a href="/{{ $locale }}/about">
          <button class="px-6 py-3 bg-primary text-white font-semibold rounded-xl hover:bg-primary/90 transition-colors duration-200 cursor-pointer">
            {{ $locale == 'id' ? 'Pelajari Lebih Lanjut' : 'Learn More' }}
          </button>
        </a>
      </div>

      <div class="grid grid-cols-2 gap-4 animate-fade-up opacity-0" style="animation-delay: 0.2s;">
        <div class="bg-white/5 rounded-2xl p-6 border border-white/10">
          <p class="text-4xl font-bold text-white mb-2">45+</p>
          <p class="text-white/60 text-sm">{{ $locale == 'id' ? 'Spesies Disurvei' : 'Species Surveyed' }}</p>
        </div>
        <div class="bg-white/5 rounded-2xl p-6 border border-white/10">
          <p class="text-4xl font-bold text-white mb-2">28</p>
          <p class="text-white/60 text-sm">{{ $locale == 'id' ? 'Publikasi' : 'Publications' }}</p>
        </div>
        <div class="bg-white/5 rounded-2xl p-6 border border-white/10">
          <p class="text-4xl font-bold text-white mb-2">12</p>
          <p class="text-white/60 text-sm">{{ $locale == 'id' ? 'Lokasi Riset' : 'Research Sites' }}</p>
        </div>
        <div class="bg-white/5 rounded-2xl p-6 border border-white/10">
          <p class="text-4xl font-bold text-white mb-2">35</p>
          <p class="text-white/60 text-sm">{{ $locale == 'id' ? 'Anggota' : 'Members' }}</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Latest News Section --}}
<section class="py-24 bg-background">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="text-center mb-16 animate-fade-up opacity-0">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-primary mb-4">
        {{ $locale == 'id' ? 'Berita Terbaru' : 'Latest News' }}
      </p>
      <h2 class="font-heading text-3xl md:text-4xl font-bold tracking-[-0.02em] text-text">
        {{ trans_for('home.latestNews.title') }}
      </h2>
    </div>

    <div class="grid md:grid-cols-3 gap-6 md:gap-8">
      <div class="bg-surface-warm rounded-2xl p-6 border border-border hover:shadow-md transition-shadow duration-300 animate-fade-up opacity-0" style="animation-delay: 0.1s;">
        <p class="text-muted text-xs mb-2">2025-03-15</p>
        <h3 class="font-heading text-lg font-semibold text-text mb-3">
          {{ $locale == 'id' ? 'Penemuan Kelelawar Baru di Kalimantan' : 'New Bat Species Discovered in Kalimantan' }}
        </h3>
        <p class="text-muted text-sm line-clamp-2">
          {{ $locale == 'id'
            ? 'Tim peneliti kami baru saja menyelesaikan survei kelelawar di kawasan hutan Sulawesi...'
            : 'Our research team has just completed a bat survey in the Sulawesi forest region...'
          }}
        </p>
      </div>

      <div class="bg-surface-warm rounded-2xl p-6 border border-border hover:shadow-md transition-shadow duration-300 animate-fade-up opacity-0" style="animation-delay: 0.2s;">
        <p class="text-muted text-xs mb-2">2025-03-10</p>
        <h3 class="font-heading text-lg font-semibold text-text mb-3">
          {{ $locale == 'id' ? 'Pelatihan Peneliti Muda di Yogyakarta' : 'Young Researcher Training in Yogyakarta' }}
        </h3>
        <p class="text-muted text-sm line-clamp-2">
          {{ $locale == 'id'
            ? 'Tim peneliti kami baru saja menyelesaikan survei kelelawar di kawasan hutan Sulawesi...'
            : 'Our research team has just completed a bat survey in the Sulawesi forest region...'
          }}
        </p>
      </div>

      <div class="bg-surface-warm rounded-2xl p-6 border border-border hover:shadow-md transition-shadow duration-300 animate-fade-up opacity-0" style="animation-delay: 0.3s;">
        <p class="text-muted text-xs mb-2">2025-03-05</p>
        <h3 class="font-heading text-lg font-semibold text-text mb-3">
          {{ $locale == 'id' ? 'Kolaborasi Riset dengan Universitas Indonesia' : 'Research Collaboration with University of Indonesia' }}
        </h3>
        <p class="text-muted text-sm line-clamp-2">
          {{ $locale == 'id'
            ? 'Tim peneliti kami baru saja menyelesaikan survei kelelawar di kawasan hutan Sulawesi...'
            : 'Our research team has just completed a bat survey in the Sulawesi forest region...'
          }}
        </p>
      </div>
    </div>
  </div>
</section>

{{-- Donate CTA Section --}}
<section class="py-24 bg-dark text-white relative overflow-hidden">
  <div class="absolute inset-0 z-0">
    <img src="https://images.unsplash.com/photo-1548777123-e216912df7d8?w=1920&q=80" alt="Bat conservation" class="w-full h-full object-cover opacity-30">
  </div>

  <div class="relative z-10 max-w-6xl mx-auto px-6 lg:px-8 text-center">
    <div class="animate-fade-up opacity-0">
      <blockquote class="font-heading text-2xl md:text-4xl font-bold mb-8">
        "{{ trans_for('home.donateCta.description') }}"
      </blockquote>
      <a href="/{{ $locale }}/donate">
        <button class="px-8 py-4 bg-cta text-white font-semibold rounded-xl hover:bg-cta/90 transition-all duration-200 cursor-pointer">
          {{ trans_for('home.donateCta.button') }}
        </button>
      </a>
    </div>
  </div>
</section>
@endsection