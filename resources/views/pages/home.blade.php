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

{{-- About Section --}}
<section class="py-24 bg-background">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
      <div class="animate-fade-up opacity-0">
        <p class="text-xs font-semibold uppercase tracking-[0.12em] text-primary mb-4">
          {{ $locale == 'id' ? 'Tentang Kami' : 'About Us' }}
        </p>
        <h2 class="font-heading text-3xl md:text-4xl font-bold tracking-[-0.02em] mb-6">
          {{ $locale == 'id' ? 'Melindungi Kelelawar Indonesia' : 'Protecting Indonesian Bats' }}
        </h2>
        <p class="text-muted leading-relaxed mb-8">
          {{ trans_for('about.description') }}
        </p>
        <a href="/{{ $locale }}/about-us">
          <button class="px-6 py-3 bg-primary text-white font-semibold rounded-xl hover:bg-primary/90 transition-colors duration-200 cursor-pointer">
            {{ $locale == 'id' ? 'Pelajari Lebih Lanjut' : 'Learn More' }}
          </button>
        </a>
      </div>
      <div class="grid grid-cols-2 gap-4 animate-fade-up opacity-0" style="animation-delay: 0.2s;">
        <div class="bg-surface-warm rounded-2xl p-6 border border-border">
          <p class="font-heading text-3xl font-bold text-primary mb-2">175+</p>
          <p class="text-muted text-sm">{{ $locale == 'id' ? 'Spesies Kelelawar' : 'Bat Species' }}</p>
        </div>
        <div class="bg-surface-warm rounded-2xl p-6 border border-border">
          <p class="font-heading text-3xl font-bold text-primary mb-2">120+</p>
          <p class="text-muted text-sm">{{ $locale == 'id' ? 'Publikasi' : 'Publications' }}</p>
        </div>
        <div class="bg-surface-warm rounded-2xl p-6 border border-border">
          <p class="font-heading text-3xl font-bold text-primary mb-2">25</p>
          <p class="text-muted text-sm">{{ $locale == 'id' ? 'Lokasi Riset' : 'Research Sites' }}</p>
        </div>
        <div class="bg-surface-warm rounded-2xl p-6 border border-border">
          <p class="font-heading text-3xl font-bold text-primary mb-2">45</p>
          <p class="text-muted text-sm">{{ $locale == 'id' ? 'Peneliti' : 'Researchers' }}</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Latest News Section --}}
<section class="py-24 bg-surface-warm border-t border-border">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="text-center mb-12 animate-fade-up opacity-0">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-primary mb-4">
        {{ $locale == 'id' ? 'Berita Terbaru' : 'Latest News' }}
      </p>
      <h2 class="font-heading text-3xl md:text-4xl font-bold tracking-[-0.02em] text-text">
        {{ trans_for('home.latestNews.title') }}
      </h2>
    </div>

    <div class="grid md:grid-cols-3 gap-6 md:gap-8">
      @forelse($latestArticles as $idx => $article)
        <a href="/{{ $locale }}/news/{{ $article->slug }}" class="bg-background rounded-2xl p-6 border border-border hover:shadow-md transition-shadow duration-300 animate-fade-up opacity-0 cursor-pointer" style="animation-delay: {{ ($idx + 1) * 0.1 }}s;">
          @if($article->featured_image_url)
            <img src="{{ $article->featured_image_url }}" alt="{{ $article->title_id }}" class="w-full h-40 object-cover rounded-lg mb-4">
          @endif
          <p class="text-muted text-xs mb-2">{{ $article->published_at ? $article->published_at->format('Y-m-d') : $article->created_at->format('Y-m-d') }}</p>
          <h3 class="font-heading text-lg font-semibold text-text mb-3">
            {{ $locale == 'id' ? $article->title_id : $article->title_en }}
          </h3>
          <p class="text-muted text-sm line-clamp-2">
            {{ $locale == 'id' ? strip_tags($article->content_id) : strip_tags($article->content_en) }}
          </p>
        </a>
      @empty
        <div class="col-span-3 text-center py-12">
          <p class="text-muted">{{ $locale == 'id' ? 'Belum ada berita' : 'No news yet' }}</p>
        </div>
      @endforelse
    </div>
  </div>
</section>

{{-- CTA Section --}}
<section class="py-20 bg-dark text-white relative overflow-hidden">
  <div class="absolute inset-0 z-0">
    <img src="{{ $siteImages['donate_cta_background']->image_url ?? '/images/Field activity/IMG_9975.webp' }}" alt="" class="w-full h-full object-cover opacity-30">
  </div>

  <div class="relative z-10 max-w-4xl mx-auto px-6 lg:px-8 text-center">
    <div class="animate-fade-up opacity-0">
      <blockquote class="font-heading text-2xl md:text-4xl font-bold mb-8">
        "{{ trans_for('donate.ctaQuote') }}"
      </blockquote>
      @if($donationEnabled ?? false)
      <a href="/{{ $locale }}/donate">
        <button class="px-8 py-4 bg-cta text-white font-semibold rounded-xl hover:bg-cta/90 transition-all duration-200 cursor-pointer">
          {{ trans_for('home.donateCta.button') }}
        </button>
      </a>
      @endif
    </div>
  </div>
</section>
@endsection