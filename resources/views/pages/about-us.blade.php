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

{{-- Vision Section --}}
<section id="vision" class="py-24 bg-surface-warm border-t border-border">
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
<section id="mission" class="py-24 bg-background border-t border-border">
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
        ['icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>', 'text' => trans_for('visionMission.mission.items.0', $locale)],
        ['icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>', 'text' => trans_for('visionMission.mission.items.1', $locale)],
        ['icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>', 'text' => trans_for('visionMission.mission.items.2', $locale)],
        ['icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>', 'text' => trans_for('visionMission.mission.items.3', $locale)],
        ['icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>', 'text' => trans_for('visionMission.mission.items.4', $locale)],
        ['icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>', 'text' => trans_for('visionMission.mission.items.5', $locale)],
      ];
      @endphp

      @foreach($missionItems as $idx => $item)
      <div class="bg-surface-warm rounded-2xl p-8 border border-border flex gap-6 animate-fade-up opacity-0" style="animation-delay: {{ ($idx + 1) * 0.1 }}s;">
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

    @php
    try {
        $allDivisions = \App\Models\Division::where('active', true)->orderBy('display_order')->get();
    } catch (\Exception $e) {
        $allDivisions = collect([]);
    }
    $divisionGroups = [];
    foreach($allDivisions as $d) {
      $divisionGroups[$d->id] = ['label_id' => $d->name_id, 'label_en' => $d->name_en, 'members' => collect()];
    }

    $unassigned = ['label_id' => 'Unassigned', 'label_en' => 'Unassigned', 'members' => collect()];
    foreach($teamMembers as $member) {
      $divKey = $member->division_id;
      if ($divKey && isset($divisionGroups[$divKey])) {
        $divisionGroups[$divKey]['members'][] = $member;
      } else {
        $unassigned['members'][] = $member;
      }
    }
    @endphp

    @foreach($divisionGroups as $divKey => $division)
      @if(count($division['members']) > 0)
      <div class="mb-12">
        <h3 class="font-heading text-xl font-semibold text-text mb-6 pb-2 border-b border-border">
          {{ $locale == 'id' ? $division['label_id'] : $division['label_en'] }}
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
          @foreach($division['members'] as $idx => $member)
          <div class="animate-fade-up opacity-0" style="animation-delay: {{ ($idx + 1) * 0.1 }}s;">
            <div class="text-center cursor-pointer group" onclick="toggleBio(this)">
              <div class="relative w-32 h-32 mx-auto mb-4 rounded-full bg-surface-warm overflow-hidden border-2 border-border group-hover:border-primary transition-colors duration-300">
                @if($member->photo_url)
                  @php $focalX = $member->photo_focal_x ?? 50; $focalY = $member->photo_focal_y ?? 50; @endphp
                  <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="w-full h-full object-cover" style="object-position: {{ $focalX }}% {{ $focalY }}%;">
                @else
                  <svg class="absolute inset-0 w-full h-full text-primary/20" viewBox="0 0 100 100" fill="currentColor">
                    <path d="M50 10c-5 0-9 4-9 9v6c-8 3-14 11-14 20 0 12 9 22 20 24v5c0 3 2 5 5 5h8c3 0 5-2 5-5v-5c11-2 20-12 20-24 0-9-6-17-14-20v-6c0-5-4-9-9-9h-12zm-3 9c0-2 2-4 4-4s4 2 4 4v6c0 2-2 4-4 4s-4-2-4-4v-6zm6 22c8 0 14 4 14 10 0 3-1 5-3 6l2 7H34l2-7c-2-1-3-3-3-6 0-6 6-10 14-10h8z"/>
                  </svg>
                @endif
              </div>
              <h4 class="font-heading text-base font-semibold text-text mb-1">{{ $member->name }}</h4>
              <p class="text-primary text-sm font-medium">{{ $locale == 'id' ? $member->title_id : $member->title_en }}</p>
            </div>
            <div class="member-bio hidden mt-6 w-full bg-surface-warm rounded-xl border border-border p-6 text-left">
              <div class="text-center">
                <h5 class="font-heading text-xl font-bold text-text mb-1">{{ $member->name }}</h5>
                <p class="text-primary text-sm font-medium mb-4">{{ $member->role ?: ($locale == 'id' ? $member->title_id : $member->title_en) }}</p>
              </div>
              <div class="border-t border-border pt-4">
                <p class="text-muted text-sm leading-relaxed whitespace-pre-line">{{ $locale == 'id' ? ($member->bio ?: $member->bio_id) : ($member->bio ?: $member->bio_en) }}</p>
              </div>
              @if($member->linkedin_url)
              <div class="mt-4 pt-4 border-t border-border flex justify-center">
                <a href="{{ $member->linkedin_url }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-primary/10 text-primary rounded-lg hover:bg-primary/20 transition-colors text-sm font-medium">
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                  LinkedIn
                </a>
              </div>
              @endif
            </div>
          </div>
          @endforeach
        </div>
      </div>
      @endif
    @endforeach

    @if(count($unassigned['members']) > 0)
    <div class="mb-12">
      <h3 class="font-heading text-xl font-semibold text-text mb-6 pb-2 border-b border-border">
        {{ $locale == 'id' ? $unassigned['label_id'] : $unassigned['label_en'] }}
      </h3>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
        @foreach($unassigned['members'] as $idx => $member)
        <div class="animate-fade-up opacity-0" style="animation-delay: {{ ($idx + 1) * 0.1 }}s;">
          <div class="text-center cursor-pointer group" onclick="toggleBio(this)">
            <div class="relative w-32 h-32 mx-auto mb-4 rounded-full bg-surface-warm overflow-hidden border-2 border-border group-hover:border-primary transition-colors duration-300">
              @if($member->photo_url)
                @php $focalX = $member->photo_focal_x ?? 50; $focalY = $member->photo_focal_y ?? 50; @endphp
                <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="w-full h-full object-cover" style="object-position: {{ $focalX }}% {{ $focalY }}%;">
              @else
                <svg class="absolute inset-0 w-full h-full text-primary/20" viewBox="0 0 100 100" fill="currentColor">
                  <path d="M50 10c-5 0-9 4-9 9v6c-8 3-14 11-14 20 0 12 9 22 20 24v5c0 3 2 5 5 5h8c3 0 5-2 5-5v-5c11-2 20-12 20-24 0-9-6-17-14-20v-6c0-5-4-9-9-9h-12zm-3 9c0-2 2-4 4-4s4 2 4 4v6c0 2-2 4-4 4s-4-2-4-4v-6zm6 22c8 0 14 4 14 10 0 3-1 5-3 6l2 7H34l2-7c-2-1-3-3-3-6 0-6 6-10 14-10h8z"/>
                </svg>
              @endif
            </div>
            <h4 class="font-heading text-base font-semibold text-text mb-1">{{ $member->name }}</h4>
            <p class="text-primary text-sm font-medium">{{ $locale == 'id' ? $member->title_id : $member->title_en }}</p>
          </div>
<div class="member-bio hidden mt-6 w-full bg-surface-warm rounded-xl border border-border p-6 text-left">
              <div class="text-center">
                <h5 class="font-heading text-xl font-bold text-text mb-1">{{ $member->name }}</h5>
                <p class="text-primary text-sm font-medium mb-4">{{ $member->role ?: ($locale == 'id' ? $member->title_id : $member->title_en) }}</p>
              </div>
              <div class="border-t border-border pt-4">
                <p class="text-muted text-sm leading-relaxed whitespace-pre-line">{{ $locale == 'id' ? ($member->bio ?: $member->bio_id) : ($member->bio ?: $member->bio_en) }}</p>
              </div>
              @if($member->linkedin_url)
              <div class="mt-4 pt-4 border-t border-border flex justify-center">
                <a href="{{ $member->linkedin_url }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-primary/10 text-primary rounded-lg hover:bg-primary/20 transition-colors text-sm font-medium">
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                  LinkedIn
                </a>
              </div>
              @endif
            </div>
        </div>
        @endforeach
      </div>
    </div>
    @endif

    @if(count($teamMembers) == 0)
    <div class="text-center py-16">
      <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
      </svg>
      <p class="text-muted">{{ $locale == 'id' ? 'Belum ada anggota tim' : 'No team members yet' }}</p>
    </div>
    @endif
  </div>
</section>
@endsection

@push('scripts')
<script>
function toggleBio(element) {
  const container = element.closest('.animate-fade-up');
  if (!container) return;
  const bio = container.querySelector('.member-bio');
  if (!bio) return;

  const allBios = document.querySelectorAll('.member-bio');
  allBios.forEach(b => {
    if (b !== bio) {
      b.classList.add('hidden');
      b.classList.remove('animate-fade-in');
    }
  });

  bio.classList.toggle('hidden');
  if (!bio.classList.contains('hidden')) {
    bio.classList.add('animate-fade-in');
    setTimeout(() => bio.classList.remove('animate-fade-in'), 300);
  }
}
</script>
@endpush