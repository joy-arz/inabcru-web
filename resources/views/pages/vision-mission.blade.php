@extends('layouts.public')

@section('title', trans_for('visionMission.title', $locale) . ' | InaBCRU')
@section('description', trans_for('visionMission.subtitle', $locale))

@section('content')
{{-- Hero Section --}}
<section class="pt-40 pb-20 relative overflow-hidden">
  <div class="absolute inset-0">
    <img src="https://images.unsplash.com/photo-1501854140801-50d01698950b?w=1920&q=80" alt="Our vision" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-dark/80"></div>
  </div>
  <div class="relative z-10 max-w-6xl mx-auto px-6 lg:px-8">
    <div class="animate-fade-up opacity-0">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-white/60 mb-4">
        {{ $locale == 'id' ? 'Visi & Misi' : 'Vision & Mission' }}
      </p>
      <h1 class="font-heading text-4xl md:text-5xl font-bold tracking-[-0.02em] mb-4 text-white">
        {{ trans_for('visionMission.title', $locale) }}
      </h1>
      <p class="text-white/70 text-lg max-w-2xl">
        {{ trans_for('visionMission.subtitle', $locale) }}
      </p>
    </div>
  </div>
</section>

{{-- Vision Section --}}
<section class="py-24 bg-background">
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
<section class="py-24 bg-surface-warm border-t border-border">
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
@endsection