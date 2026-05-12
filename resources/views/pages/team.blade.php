@extends('layouts.public')

@section('title', trans_for('team.title') . ' | InaBCRU')
@section('description', trans_for('team.subtitle'))

@section('content')
{{-- Hero Section --}}
<section class="pt-40 pb-16 relative overflow-hidden">
  <div class="absolute inset-0">
    <img src="/images/Field activity/IMG_2214.webp" alt="Research team in field" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-dark/80"></div>
  </div>
  <div class="relative z-10 max-w-6xl mx-auto px-6 lg:px-8">
    <div class="animate-fade-up opacity-0">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-white/60 mb-4">
        {{ $locale == 'id' ? 'Tim Kami' : 'Our Team' }}
      </p>
      <h1 class="font-heading text-4xl md:text-5xl font-bold tracking-[-0.02em] mb-4 text-white">
        {{ trans_for('team.title') }}
      </h1>
      <p class="text-white/70 text-lg max-w-2xl">
        {{ trans_for('team.subtitle') }}
      </p>
    </div>
  </div>
</section>

{{-- Team Grid Section --}}
<section class="py-16 bg-background">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
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