@extends('layouts.public')

@section('title', trans_for('about.title') . ' | InaBCRU')
@section('description', trans_for('about.description'))

@section('content')
{{-- Hero Section --}}
<section class="relative min-h-[60svh] flex items-center justify-start overflow-hidden">
  <div class="absolute inset-0">
    <img src="{{ $siteImages['hero_about_us']->image_url ?? '/images/Field activity/IMG_2175.webp' }}" alt="{{ $siteImages['hero_about_us']->alt_text ?? 'Indonesian forest landscape' }}" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-dark/70"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-dark/60 via-transparent to-transparent"></div>
  </div>
  <div class="relative z-10 max-w-6xl mx-auto px-6 lg:px-8">
    <div class="animate-fade-up opacity-0">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-white/60 mb-4">
        {{ $locale == 'id' ? 'Tentang Kami' : 'About Us' }}
      </p>
      <h1 class="font-heading text-4xl md:text-5xl font-bold tracking-[-0.02em] mb-4 text-white">
        {{ trans_for('about.title') }}
      </h1>
      <p class="text-white/70 text-lg max-w-2xl">
        {{ trans_for('about.description') }}
      </p>
    </div>
  </div>
</section>

{{-- About Content Section --}}
<section id="about" class="py-24 bg-background">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center animate-fade-up opacity-0">
      <div class="relative aspect-[4/3] rounded-2xl overflow-hidden">
        <img src="{{ $siteImages['about_section_team']->image_url ?? '/images/Field activity/IMG_6290.webp' }}" alt="{{ $siteImages['about_section_team']->alt_text ?? 'Bat research in field' }}" class="w-full h-full object-cover">
      </div>
      <div>
        <p class="text-xs font-semibold uppercase tracking-[0.12em] text-primary mb-4">
          {{ $locale == 'id' ? 'Tentang Kami' : 'About Us' }}
        </p>
        <h2 class="font-heading text-3xl md:text-4xl font-bold tracking-[-0.02em] text-text mb-6">
          {{ $locale == 'id' ? 'Membangun Masa Depan Konservasi' : 'Building the Future of Conservation' }}
        </h2>
        <p class="text-muted mb-4 leading-relaxed">
          {{ trans_for('about.description') }}
        </p>
        <p class="text-muted mb-4 leading-relaxed">
          {{ trans_for('about.founded') }}
        </p>
        <p class="text-muted font-medium">
          {{ trans_for('about.legalId') }}
        </p>
      </div>
    </div>
  </div>
</section>

{{-- Values Section --}}
<section id="values" class="py-24 bg-surface-warm border-t border-border">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="text-center mb-16 animate-fade-up opacity-0">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-primary mb-4">
        {{ $locale == 'id' ? 'Nilai-Nilai Kami' : 'Our Values' }}
      </p>
      <h2 class="font-heading text-3xl md:text-4xl font-bold tracking-[-0.02em] text-text">
        {{ $locale == 'id' ? 'Prinsip yang Memandu Kami' : 'Principles That Guide Us' }}
      </h2>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
      <div class="bg-background rounded-2xl p-6 md:p-8 border border-border text-center group hover:border-primary/30 transition-colors cursor-pointer animate-fade-up opacity-0" style="animation-delay: 0.1s;">
        <h3 class="font-heading text-lg font-semibold text-text mb-3">
          {{ $locale == 'id' ? 'Integritas' : 'Integrity' }}
        </h3>
        <p class="text-muted text-sm leading-relaxed">
          {{ $locale == 'id' ? 'Menjunjung tinggi kejujuran dan transparansi dalam setiap kegiatan' : 'Upholding honesty and transparency in every activity' }}
        </p>
      </div>

      <div class="bg-background rounded-2xl p-6 md:p-8 border border-border text-center group hover:border-primary/30 transition-colors cursor-pointer animate-fade-up opacity-0" style="animation-delay: 0.2s;">
        <h3 class="font-heading text-lg font-semibold text-text mb-3">
          {{ $locale == 'id' ? 'Keunggulan' : 'Excellence' }}
        </h3>
        <p class="text-muted text-sm leading-relaxed">
          {{ $locale == 'id' ? 'Berdedikasi untuk hasil penelitian berkualitas tinggi' : 'Dedicated to high-quality research outcomes' }}
        </p>
      </div>

      <div class="bg-background rounded-2xl p-6 md:p-8 border border-border text-center group hover:border-primary/30 transition-colors cursor-pointer animate-fade-up opacity-0" style="animation-delay: 0.3s;">
        <h3 class="font-heading text-lg font-semibold text-text mb-3">
          {{ $locale == 'id' ? 'Kolaborasi' : 'Collaboration' }}
        </h3>
        <p class="text-muted text-sm leading-relaxed">
          {{ $locale == 'id' ? 'Membangun kemitraan yang kuat dengan berbagai pihak' : 'Building strong partnerships with various stakeholders' }}
        </p>
      </div>

      <div class="bg-background rounded-2xl p-6 md:p-8 border border-border text-center group hover:border-primary/30 transition-colors cursor-pointer animate-fade-up opacity-0" style="animation-delay: 0.4s;">
        <h3 class="font-heading text-lg font-semibold text-text mb-3">
          {{ $locale == 'id' ? 'Konservasi' : 'Conservation' }}
        </h3>
        <p class="text-muted text-sm leading-relaxed">
          {{ $locale == 'id' ? 'Berkomitmen untuk melindungi kelelawar dan habitatnya' : 'Committed to protecting bats and their habitats' }}
        </p>
      </div>
    </div>
  </div>
</section>

{{-- Vision Section --}}
<section id="vision" class="py-24 bg-background">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="max-w-3xl mx-auto text-center mb-16 animate-fade-up opacity-0">
      <div class="w-16 h-16 rounded-2xl bg-primary/10 flex items-center justify-center mx-auto mb-6">
        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        </svg>
      </div>
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-primary mb-4">{{ trans_for('visionMission.vision.title', $locale) }}</p>
      <h2 class="font-heading text-3xl md:text-4xl font-bold tracking-[-0.02em] text-text mb-6">
        {{ trans_for('visionMission.vision.title', $locale) }}
      </h2>
      <p class="text-muted text-lg leading-relaxed">
        {{ trans_for('visionMission.vision.description', $locale) }}
      </p>
    </div>
  </div>
</section>

{{-- Mission Section --}}
<section id="mission" class="py-24 bg-surface-warm border-t border-border">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="text-center mb-16 animate-fade-up opacity-0">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-primary mb-4">{{ trans_for('visionMission.mission.title', $locale) }}</p>
      <h2 class="font-heading text-3xl md:text-4xl font-bold tracking-[-0.02em] text-text">
        {{ trans_for('visionMission.mission.title', $locale) }}
      </h2>
    </div>

    <div class="grid md:grid-cols-2 gap-6 md:gap-8">
      @php
      $missionItems = [
        ['icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>', 'text' => trans_for('visionMission.mission.items.0', $locale)],
        ['icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>', 'text' => trans_for('visionMission.mission.items.1', $locale)],
        ['icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>', 'text' => trans_for('visionMission.mission.items.2', $locale)],
        ['icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>', 'text' => trans_for('visionMission.mission.items.3', $locale)],
      ];
      @endphp

      @foreach($missionItems as $idx => $item)
      <div class="bg-background rounded-2xl p-8 border border-border flex gap-6 animate-fade-up opacity-0" style="animation-delay: {{ ($idx + 1) * 0.1 }}s;">
        <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
          {!! $item['icon'] !!}
        </div>
        <p class="text-muted leading-relaxed">{{ $item['text'] }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Team Section --}}
<section id="team" class="py-24 bg-background border-t border-border">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="text-center mb-16 animate-fade-up opacity-0">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-primary mb-4">
        {{ $locale == 'id' ? 'Tim Kami' : 'Our Team' }}
      </p>
      <h2 class="font-heading text-3xl md:text-4xl font-bold tracking-[-0.02em] text-text">
        {{ $locale == 'id' ? 'Orang-Orang di Balik InaBCRU' : 'The People Behind InaBCRU' }}
      </h2>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
      @forelse($teamMembers as $idx => $member)
        <div class="text-center group cursor-pointer animate-fade-up opacity-0" style="animation-delay: {{ ($idx + 1) * 0.1 }}s;">
          <div class="relative w-24 h-24 mx-auto mb-4 rounded-full bg-surface-warm overflow-hidden border-2 border-border group-hover:border-primary transition-colors duration-300">
            @if($member->photo_url)
              <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
            @else
              <svg class="absolute inset-0 w-full h-full text-primary/20" viewBox="0 0 100 100" fill="currentColor">
                <path d="M50 10c-5 0-9 4-9 9v6c-8 3-14 11-14 20 0 12 9 22 20 24v5c0 3 2 5 5 5h8c3 0 5-2 5-5v-5c11-2 20-12 20-24 0-9-6-17-14-20v-6c0-5-4-9-9-9h-12zm-3 9c0-2 2-4 4-4s4 2 4 4v6c0 2-2 4-4 4s-4-2-4-4v-6zm6 22c8 0 14 4 14 10 0 3-1 5-3 6l2 7H34l2-7c-2-1-3-3-3-6 0-6 6-10 14-10h8z"/>
              </svg>
            @endif
          </div>
          <h3 class="font-heading text-lg font-semibold text-text mb-1">
            {{ $member->name }}
          </h3>
          <p class="text-cta text-sm font-medium mb-2">{{ $locale == 'id' ? $member->title_id : $member->title_en }}</p>
          <p class="text-muted text-sm">{{ $locale == 'id' ? ($member->bio_id ?: '') : ($member->bio_en ?: '') }}</p>
        </div>
      @empty
        <div class="col-span-4 text-center py-16">
          <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
          </svg>
          <p class="text-muted">{{ $locale == 'id' ? 'Belum ada anggota tim' : 'No team members yet' }}</p>
        </div>
      @endforelse
    </div>
  </div>
</section>

{{-- Join Team Section --}}
<section class="py-16 bg-surface-warm border-t border-border">
  <div class="max-w-6xl mx-auto px-6 lg:px-8 text-center animate-fade-up opacity-0">
    <h2 class="font-heading text-2xl font-bold text-text mb-4">
      {{ $locale == 'id' ? 'Bergabung dengan Tim Kami' : 'Join Our Team' }}
    </h2>
    <p class="text-muted mb-6 max-w-xl mx-auto">
      {{ $locale == 'id' ? 'Kami selalu mencari sukarelawan dan peneliti yang passionate tentang konservasi kelelawar.' : 'We are always looking for passionate volunteers and researchers in bat conservation.' }}
    </p>
    <a href="mailto:info.inabcru@gmail.com" class="text-primary hover:underline font-medium">
      info.inabcru@gmail.com
    </a>
  </div>
</section>
@endsection