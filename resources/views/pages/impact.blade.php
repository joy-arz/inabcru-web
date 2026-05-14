@extends('layouts.public')

@section('title', trans_for('nav.impact', $locale) . ' | InaBCRU')
@section('description', trans_for('impact.subtitle', $locale))

@section('content')
{{-- Hero Section --}}
<section class="relative min-h-[50svh] flex items-center justify-start overflow-hidden">
  <div class="absolute inset-0">
    <img src="{{ $siteImages['hero_impact']->image_url ?? '/images/Field activity/IMG_4469.webp' }}" alt="{{ $siteImages['hero_impact']->alt_text ?? 'Our impact' }}" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-dark/70"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-dark/60 via-transparent to-transparent"></div>
  </div>
  <div class="relative z-10 max-w-6xl mx-auto px-6 lg:px-8">
    <div class="animate-fade-up opacity-0">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-white/60 mb-4">
        {{ $locale == 'id' ? 'Dampak' : 'Impact' }}
      </p>
      <h1 class="font-heading text-4xl md:text-5xl font-bold tracking-[-0.02em] mb-4 text-white">
        {{ trans_for('impact.title', $locale) }}
      </h1>
      <p class="text-white/70 text-lg max-w-2xl">
        {{ trans_for('impact.subtitle', $locale) }}
      </p>
    </div>
  </div>
</section>

{{-- Stats Section --}}
<section class="py-24 bg-background">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="grid grid-cols-2 md:grid-cols-5 gap-6 md:gap-8 mb-16">
      @php
      $stats = [
        ['value' => '45+', 'label' => $locale == 'id' ? 'Spesies Disurvei' : 'Species Surveyed'],
        ['value' => '12', 'label' => $locale == 'id' ? 'Lokasi Riset' : 'Research Sites'],
        ['value' => '28', 'label' => $locale == 'id' ? 'Publikasi Ilmiah' : 'Publications'],
        ['value' => '35', 'label' => $locale == 'id' ? 'Anggota Aktif' : 'Active Members'],
        ['value' => '8', 'label' => $locale == 'id' ? 'Kegiatan Pelatihan' : 'Training Activities'],
      ];
      @endphp

      @foreach($stats as $idx => $stat)
        <div class="text-center animate-fade-up opacity-0" style="animation-delay: {{ ($idx + 1) * 0.1 }}s;">
          <div class="font-heading text-3xl md:text-4xl font-bold text-primary mb-2">
            {{ $stat['value'] }}
          </div>
          <div class="text-muted text-sm">{{ $stat['label'] }}</div>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Impact Areas Section --}}
<section class="py-24 bg-surface-warm border-t border-border">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="text-center mb-16 animate-fade-up opacity-0">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-primary mb-4">
        {{ $locale == 'id' ? 'Dampak' : 'Impact' }}
      </p>
      <h2 class="font-heading text-3xl md:text-4xl font-bold tracking-[-0.02em] text-text">
        {{ $locale == 'id' ? 'Bidang Dampak' : 'Areas of Impact' }}
      </h2>
    </div>

    <div class="grid md:grid-cols-2 gap-6 md:gap-8">
      @php
      $impactAreas = [
        [
          'title' => $locale == 'id' ? 'Konservasi Spesies' : 'Species Conservation',
          'description' => $locale == 'id'
            ? 'Kami telah mengidentifikasi dan mendokumentasikan lebih dari 45 spesies kelelawar di Indonesia, termasuk beberapa spesies endemik yang hanya ditemukan di bestimmten wilayah.'
            : 'We have identified and documented more than 45 bat species in Indonesia, including several endemic species found only in specific regions.',
          'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>'
        ],
        [
          'title' => $locale == 'id' ? 'Penelitian Ilmiah' : 'Scientific Research',
          'description' => $locale == 'id'
            ? 'Hasil penelitian kami telah dipublikasikan di berbagai jurnal ilmiah nasional dan internasional untuk mendukung konservasi kelelawar berbasis bukti.'
            : 'Our research results have been published in various national and international scientific journals to support evidence-based bat conservation.',
          'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>'
        ],
        [
          'title' => $locale == 'id' ? 'Edukasi Masyarakat' : 'Public Education',
          'description' => $locale == 'id'
            ? 'Kami telah melatih ratusan mahasiswa dan masyarakat tentang pentingnya kelelawar dalam ekosistem dan cara melindungi mereka.'
            : 'We have trained hundreds of students and community members about the importance of bats in ecosystems and how to protect them.',
          'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>'
        ],
        [
          'title' => $locale == 'id' ? 'Perlindungan Habitat' : 'Habitat Protection',
          'description' => $locale == 'id'
            ? 'Kami bekerja sama dengan pemerintah daerah untuk melindungi gua-gua dan habitat kelelawar lainnya dari gangguan manusia.'
            : 'We collaborate with local governments to protect caves and other bat habitats from human disturbance.',
          'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
        ],
      ];
      @endphp

      @foreach($impactAreas as $idx => $area)
        <div class="bg-background rounded-2xl p-8 border border-border flex gap-6 animate-fade-up opacity-0" style="animation-delay: {{ ($idx + 1) * 0.1 }}s;">
          <div class="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
            {!! $area['icon'] !!}
          </div>
          <div>
            <h3 class="font-heading text-xl font-semibold text-text mb-2">
              {{ $area['title'] }}
            </h3>
            <p class="text-muted leading-relaxed">
              {{ $area['description'] }}
            </p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Testimonial Section --}}
<section class="py-24 bg-background">
  <div class="max-w-4xl mx-auto px-6 lg:px-8">
    <div class="text-center animate-fade-up opacity-0">
      <h2 class="font-heading text-3xl md:text-4xl font-bold text-text mb-8">
        {{ $locale == 'id' ? 'Cerita Dampak' : 'Impact Stories' }}
      </h2>

      <blockquote class="text-xl text-muted italic mb-8 border-l-4 border-cta pl-6 text-left leading-relaxed">
        "{{ $locale == 'id' 
          ? 'Berkat penelitian InaBCRU, kami berhasil mengidentifikasi koloni kelelawar langka di daerah kami dan mengambil langkah untuk melindunginya.'
          : 'Thanks to InaBCRU research, we successfully identified a rare bat colony in our area and took steps to protect it.'
        }}"
        <footer class="text-sm text-muted/70 mt-4 not-italic">
          — {{ $locale == 'id' ? 'Kepala Desa, Sulawesi' : 'Village Head, Sulawesi' }}
        </footer>
      </blockquote>
    </div>
  </div>
</section>
@endsection