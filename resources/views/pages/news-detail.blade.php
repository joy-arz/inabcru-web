@extends('layouts.public')

@section('title', ($locale == 'id' ? $article->title_id : $article->title_en) . ' | InaBCRU')
@section('description', $locale == 'id' ? strip_tags($article->content_id) : strip_tags($article->content_en))

@section('content')
{{-- Article Header Section --}}
<section class="pt-32 pb-8 bg-background">
  <div class="max-w-3xl mx-auto px-6 lg:px-8">
    {{-- Category/Page Header --}}
    <p class="article-category">
      {{ ucfirst($article->category) }}
    </p>

    {{-- News Title --}}
    <h1 class="article-title">
      {{ $locale == 'id' ? $article->title_id : $article->title_en }}
    </h1>

    {{-- Location & Date --}}
    <div class="article-meta">
      @if($article->meta_location_id)
        <span>{{ $locale == 'id' ? $article->meta_location_id : $article->meta_location_en }}</span>
        <span class="meta-separator">•</span>
      @endif
      @if($article->published_at)
        <span>{{ $article->published_at->format('M d, Y') }}</span>
      @endif
    </div>
  </div>
</section>

{{-- Featured Image --}}
@if($article->featured_image_url)
<section class="pb-12 bg-background">
  <div class="max-w-3xl mx-auto px-6 lg:px-8">
    <img src="{{ $article->featured_image_url }}" alt="{{ $locale == 'id' ? $article->title_id : $article->title_en }}" class="article-featured-image" />
  </div>
</section>
@endif

{{-- Article Content --}}
<section class="pb-24 bg-background">
  <div class="max-w-3xl mx-auto px-6 lg:px-8">
    <article class="article-content">
      @if($locale == 'id')
        {!! $article->content_id !!}
      @else
        {!! $article->content_en !!}
      @endif
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

@push('styles')
<style>
.article-category {
  font-size: 11px;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: #888;
  margin: 0 0 0.75rem;
}

.article-title {
  font-size: 32px;
  font-weight: 700;
  line-height: 1.2;
  margin: 0 0 1.25rem;
  color: #0F1117;
}

.article-meta {
  font-size: 12px;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  color: #888;
  border-top: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
  padding: 0.5rem 0;
  margin: 0 0 1.5rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.article-meta .meta-separator {
  opacity: 0.5;
}

.article-featured-image {
  width: 100%;
  height: auto;
  display: block;
  border-radius: 8px;
  margin: 0;
}

.article-content p {
  font-size: 16px;
  line-height: 1.8;
  margin: 0 0 1.25rem;
  color: #0F1117;
}

.article-content p strong {
  font-weight: 600;
}

.article-content h2 {
  font-size: 24px;
  font-weight: 700;
  line-height: 1.3;
  margin: 2rem 0 1rem;
  color: #0F1117;
}

.article-content h3 {
  font-size: 20px;
  font-weight: 600;
  line-height: 1.4;
  margin: 1.5rem 0 0.75rem;
  color: #0F1117;
}

.article-content img {
  width: 100%;
  height: auto;
  display: block;
  border-radius: 8px;
  margin: 1.5rem 0;
}

.article-content ul,
.article-content ol {
  margin: 0 0 1.25rem;
  padding-left: 1.4rem;
}

.article-content li {
  font-size: 16px;
  line-height: 1.7;
  margin-bottom: 0.4rem;
  color: #0F1117;
}

.article-content blockquote {
  border-left: 3px solid #aaa;
  padding: 0.75rem 1rem;
  margin: 1.5rem 0 0;
  background: #f8f8f8;
  border-radius: 0 8px 8px 0;
}

.article-content blockquote p {
  margin: 0;
}

.article-content a {
  color: #2B3984;
  text-decoration: underline;
}

.article-content a:hover {
  color: #F97316;
}

.article-content .image-grid {
  display: flex;
  gap: 10px;
  margin: 1.5rem 0;
  width: 100%;
}

.article-content .image-grid img {
  display: inline-block;
  width: calc(50% - 5px);
  max-width: calc(50% - 5px);
  margin: 0;
}
</style>
@endpush