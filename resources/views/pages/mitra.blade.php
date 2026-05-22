@extends('layouts.public')

@section('title', trans_for('mitra.title') . ' | InaBCRU')
@section('description', trans_for('mitra.subtitle'))

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
        {{ $locale == 'id' ? 'Mitra' : 'Partners' }}
      </p>
      <h1 class="font-heading text-4xl md:text-5xl font-bold tracking-[-0.02em] mb-4 text-white">
        {{ trans_for('mitra.title') }}
      </h1>
      <p class="text-white/70 text-lg max-w-2xl">
        {{ trans_for('mitra.subtitle') }}
      </p>
    </div>
  </div>
</section>

{{-- Partners Grid --}}
<section class="py-24 bg-background">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    @forelse($partners as $idx => $partner)
      <div class="bg-surface-warm rounded-2xl p-8 border border-border mb-8 animate-fade-up opacity-0" style="animation-delay: {{ ($idx + 1) * 0.1 }}s;">
        <div class="flex flex-col md:flex-row gap-8 items-center">
          @if($partner->logo_url)
          <div class="w-full md:w-48 flex-shrink-0">
            <img src="{{ $partner->logo_url }}" alt="{{ $partner->alt_text ?: $partner->name }}" class="h-24 w-full object-contain">
          </div>
          @endif
          <div class="flex-1 text-center md:text-left">
            <h3 class="font-heading text-xl font-semibold text-text mb-2">{{ $partner->name }}</h3>
            <p class="text-muted text-sm leading-relaxed">{{ $partner->description ?: '' }}</p>
            @if($partner->website_url)
            <a href="{{ $partner->website_url }}" target="_blank" class="text-primary hover:underline text-sm mt-2 inline-block">
              {{ $locale == 'id' ? 'Kunjungi Website' : 'Visit Website' }} →
            </a>
            @endif
          </div>
        </div>
      </div>
    @empty
      <div class="text-center py-16">
        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
        </svg>
        <p class="text-muted">{{ $locale == 'id' ? 'Belum ada mitra' : 'No partners yet' }}</p>
      </div>
    @endforelse
  </div>
</section>
@endsection