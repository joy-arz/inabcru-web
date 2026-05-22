@extends('layouts.public')

@section('title', trans_for('metadata.title'))
@section('description', trans_for('metadata.description'))

@section('content')
<section class="relative min-h-[100svh] flex items-center justify-center overflow-hidden">
  <div class="absolute inset-0">
    @if(($siteImages['hero_home_video']->image_url ?? false) && ($siteImages['hero_home_video']->type ?? 'image') === 'video')
    <video autoplay loop muted playsinline class="w-full h-full object-cover">
      <source src="{{ $siteImages['hero_home_video']->image_url }}" type="video/mp4">
    </video>
    @else
    <img src="{{ $siteImages['hero_home']->image_url ?? '/images/Field activity/IMG_9975.webp' }}" alt="{{ $siteImages['hero_home']->alt_text ?? 'Bat in natural habitat' }}" class="w-full h-full object-cover">
    @endif
    <div class="absolute inset-0 bg-dark/75"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-dark/40 via-transparent to-transparent"></div>
    <div class="absolute inset-0" style="background: radial-gradient(ellipse at center, transparent 0%, rgba(15, 23, 42, 0.4) 100%);"></div>
  </div>

  <div class="relative z-10 max-w-6xl mx-auto px-6 lg:px-8 text-center">
    <div class="animate-fade-up opacity-0">
      <h1 class="font-heading text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
        {{ trans_for('home.hero.title') }}
      </h1>
      <p class="text-lg md:text-xl text-white/70 mb-10 max-w-2xl mx-auto">
        {{ trans_for('home.hero.subtitle') }}
      </p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="/{{ $locale }}/about-us">
          <button class="px-8 py-4 border-2 border-white/30 text-white font-semibold rounded-xl hover:bg-white/10 transition-all duration-200 cursor-pointer">
            {{ trans_for('nav.about') }}
          </button>
        </a>
      </div>
    </div>
  </div>

  <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-background to-transparent"></div>
</section>
@endsection