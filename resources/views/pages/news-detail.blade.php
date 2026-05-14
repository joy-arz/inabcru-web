@extends('layouts.public')

@section('title', ($locale == 'id' ? $article->title_id : $article->title_en) . ' | InaBCRU')
@section('description', $locale == 'id' ? strip_tags($article->content_id) : strip_tags($article->content_en))

@section('content')
{{-- Hero Section --}}
<section class="relative min-h-[50svh] flex items-center justify-center overflow-hidden">
  <div class="absolute inset-0">
    <img src="{{ $siteImages['hero_news_detail']->image_url ?? '/images/Field activity/IMG_0909.webp' }}" alt="{{ $siteImages['hero_news_detail']->alt_text ?? 'News article' }}" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-dark/70"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-dark/60 via-transparent to-transparent"></div>
  </div>
  <div class="relative z-10 max-w-6xl mx-auto px-6 lg:px-8">
    <a href="/{{ $locale }}/news" class="inline-flex items-center gap-2 text-white/60 hover:text-white mb-6 transition-colors">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
      {{ $locale == 'id' ? 'Kembali ke Berita' : 'Back to News' }}
    </a>
    <div class="animate-fade-up opacity-0">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-white/60 mb-4">
        {{ ucfirst($article->category) }}
      </p>
      <h1 class="font-heading text-4xl md:text-5xl font-bold tracking-[-0.02em] mb-4 text-white">
        {{ $locale == 'id' ? $article->title_id : $article->title_en }}
      </h1>
      <div class="flex items-center gap-4 text-white/60 text-sm">
        @if($article->published_at)
          <span>{{ $article->published_at->format('M d, Y') }}</span>
        @endif
        @if($article->meta_location_id)
          <span>•</span>
          <span>{{ $locale == 'id' ? $article->meta_location_id : $article->meta_location_en }}</span>
        @endif
      </div>
    </div>
  </div>
</section>

{{-- Article Content --}}
<section class="py-24 bg-background">
  <div class="max-w-3xl mx-auto px-6 lg:px-8">
    <article class="animate-fade-up opacity-0">
      <div class="prose prose-lg max-w-none">
        @if($locale == 'id')
          {!! $article->content_id !!}
        @else
          {!! $article->content_en !!}
        @endif
      </div>
    </article>

    <div class="mt-12 pt-8 border-t border-border">
      <a href="/{{ $locale }}/news" class="inline-flex items-center gap-2 text-primary hover:text-primary/80 font-medium transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        {{ $locale == 'id' ? 'Kembali ke Berita' : 'Back to News' }}
      </a>
    </div>
  </div>
</section>
@endsection