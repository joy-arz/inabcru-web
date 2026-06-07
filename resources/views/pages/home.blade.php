@extends('layouts.public')

@section('title', trans_for('metadata.title'))
@section('description', trans_for('metadata.description'))

@section('content')
@php
$heroHome = $siteImages['hero_home'] ?? null;
$heroUrl = $heroHome->image_url ?? null;
$heroType = $heroHome->type ?? 'image';
@endphp
<section class="relative min-h-[100svh] flex items-center justify-center overflow-hidden">
  <div class="absolute inset-0" id="heroMedia">
    @if($heroUrl && $heroType === 'video')
    <video autoplay loop muted playsinline class="w-full h-full object-cover">
      <source src="{{ $heroUrl }}" type="video/webm">
    </video>
    @elseif($heroUrl)
    <img src="{{ $heroUrl }}" alt="{{ $heroHome->alt_text ?? 'Bat in natural habitat' }}" class="w-full h-full object-cover" id="heroImage">
    @else
    <img src="/images/Field activity/IMG_9975.webp" alt="Bat in natural habitat" class="w-full h-full object-cover" id="heroImage">
    @endif
    <div class="absolute inset-0 bg-dark/75"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-dark/40 via-transparent to-transparent"></div>
    <div class="absolute inset-0" style="background: radial-gradient(ellipse at center, transparent 0%, rgba(15, 23, 42, 0.4) 100%);"></div>
  </div>

  <div class="relative z-10 max-w-6xl mx-auto px-6 lg:px-8 text-center">
    <div class="animate-fade-up opacity-0">
      <img src="/images/Logo/InaBCRU_LOGO GELAP B.webp" alt="InaBCRU" class="w-32 md:w-40 mx-auto mb-6">
      <h1 class="font-heading text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
        {{ trans_for('home.hero.title') }}
      </h1>
      <p class="text-lg md:text-xl text-white/70 mb-10 max-w-2xl mx-auto">
        {{ trans_for('home.hero.subtitle') }}
      </p>
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
        
      </p>
        <h2 class="font-heading text-3xl md:text-4xl font-bold tracking-[-0.02em] mb-6">
          {{ $locale == 'id' ? 'Melindungi Kelelawar Indonesia' : 'Protecting Indonesian Bats' }}
        </h2>
        <p class="text-muted leading-relaxed mb-8">
          {{ trans_for('about.description') }}
        </p>
        <a href="/{{ $locale }}/about-us">
          <button class="px-6 py-3 border-2 border-primary text-primary font-semibold rounded-xl hover:bg-primary/5 transition-colors duration-200 cursor-pointer">
            {{ $locale == 'id' ? 'Tentang Kami' : 'About Us' }}
          </button>
        </a>
        <a href="/{{ $locale }}/contact">
          <button class="px-6 py-3 bg-cta text-white font-semibold rounded-xl hover:bg-cta/90 transition-colors duration-200 cursor-pointer">
            {{ $locale == 'id' ? 'Hubungi Kami' : 'Contact Us' }}
          </button>
        </a>
      </div>
      <div class="grid grid-cols-2 gap-4 animate-fade-up opacity-0" style="animation-delay: 0.2s;">
        @foreach($stats as $stat)
        <div class="bg-surface-warm rounded-2xl p-6 border border-border flex items-start gap-4">
          @if($stat->icon)
          <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
            <i class="{{ $stat->icon }} text-lg"></i>
          </div>
          @endif
          <div>
            <p class="font-heading text-3xl font-bold text-primary mb-1">{{ $stat->value }}</p>
            <p class="text-muted text-sm">{{ $locale == 'id' ? $stat->label_id : $stat->label_en }}</p>
          </div>
        </div>
        @endforeach
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

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      @forelse($latestArticles as $idx => $article)
        <div class="animate-fade-up opacity-0" style="animation-delay: {{ ($idx + 1) * 0.1 }}s;">
          <a href="/{{ $locale }}/news/{{ $article->slug }}" class="group block bg-surface-warm rounded-2xl overflow-hidden border border-border hover:shadow-lg transition-shadow duration-300 cursor-pointer">
            @if($article->featured_image_url)
              <div class="relative aspect-[16/10] w-full overflow-hidden">
                <img src="{{ $article->featured_image_url }}" alt="{{ $locale == 'id' ? $article->title_id : $article->title_en }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/5 transition-colors duration-300"></div>
              </div>
            @endif
            <div class="p-6">
              <p class="text-muted text-xs mb-2">{{ $article->published_at ? $article->published_at->format('Y-m-d') : $article->created_at->format('Y-m-d') }}</p>
              <h3 class="font-heading text-lg font-semibold text-text mb-3">
                {{ $locale == 'id' ? $article->title_id : $article->title_en }}
              </h3>
              <p class="text-muted text-sm line-clamp-2">
                {{ $locale == 'id' ? strip_tags($article->content_id) : strip_tags($article->content_en) }}
              </p>
            </div>
          </a>
        </div>
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