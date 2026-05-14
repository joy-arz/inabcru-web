@extends('layouts.public')

@section('title', trans_for('nav.news', $locale) . ' | InaBCRU')
@section('description', trans_for('news.subtitle', $locale))

@section('content')
{{-- Hero Section --}}
<section class="relative min-h-[50svh] flex items-center justify-start overflow-hidden">
  <div class="absolute inset-0">
    <img src="{{ $siteImages['hero_news']->image_url ?? '/images/Field activity/IMG_0909.webp' }}" alt="{{ $siteImages['hero_news']->alt_text ?? 'News and updates' }}" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-dark/70"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-dark/60 via-transparent to-transparent"></div>
  </div>
  <div class="relative z-10 max-w-6xl mx-auto px-6 lg:px-8">
    <div class="animate-fade-up opacity-0">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-white/60 mb-4">
        {{ $locale == 'id' ? 'Berita' : 'News' }}
      </p>
      <h1 class="font-heading text-4xl md:text-5xl font-bold tracking-[-0.02em] mb-4 text-white">
        {{ trans_for('news.title', $locale) }}
      </h1>
      <p class="text-white/70 text-lg">
        {{ trans_for('news.subtitle', $locale) }}
      </p>
    </div>
  </div>
</section>

{{-- News Grid Section --}}
<section class="py-24 bg-background">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    @if($articles->isEmpty())
      <div class="text-center py-16">
        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
        </svg>
        <p class="text-muted">{{ $locale == 'id' ? 'Belum ada berita' : 'No news yet' }}</p>
      </div>
    @else
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
        @foreach($articles as $idx => $article)
          <div class="animate-fade-up opacity-0" style="animation-delay: {{ ($idx + 1) * 0.1 }}s;">
            <a href="/{{ $locale }}/news/{{ $article->slug }}" class="group block bg-surface-warm rounded-2xl overflow-hidden border border-border hover:shadow-lg transition-shadow duration-300 cursor-pointer">
              @if($article->featured_image_url)
                <div class="relative aspect-[16/10] w-full overflow-hidden">
                  <img src="{{ $article->featured_image_url }}" alt="{{ $locale == 'id' ? $article->title_id : $article->title_en }}" class="w-full h-full object-cover">
                  <div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/5 transition-colors duration-300"></div>
                </div>
              @endif
              <div class="p-6">
                <div class="text-xs text-muted mb-2 capitalize">{{ $article->category }}</div>
                <h3 class="font-heading text-lg font-semibold text-text mb-2 group-hover:text-primary transition-colors line-clamp-2">
                  {{ $locale == 'id' ? $article->title_id : $article->title_en }}
                </h3>
                @if($locale == 'id' && $article->content_id)
                  <p class="text-muted text-sm mb-4 line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($article->content_id), 100) }}</p>
                @elseif($article->content_en)
                  <p class="text-muted text-sm mb-4 line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($article->content_en), 100) }}</p>
                @endif
              </div>
            </a>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>
@endsection