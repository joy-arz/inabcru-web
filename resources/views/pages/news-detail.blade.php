@extends('layouts.public')

@section('title', ($locale == 'id' ? $article->title_id : $article->title_en) . ' | InaBCRU')
@section('description', $locale == 'id' ? strip_tags($article->content_id) : strip_tags($article->content_en))

@section('content')
<style>
.article-sidebar {
  position: sticky;
  top: 7rem;
  height: fit-content;
  max-height: calc(100vh - 8rem);
  overflow-y: auto;
}
</style>

<div class="pt-32 pb-24 bg-background">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="flex gap-8">

      {{-- Main Content --}}
      <div class="flex-1 min-w-0">
        {{-- Category --}}
        <p class="text-xs font-semibold uppercase tracking-widest text-primary mb-4">
          {{ ucfirst($article->category) }}
        </p>

        {{-- Title --}}
        <h1 class="font-heading text-3xl md:text-4xl font-bold text-text mb-4 leading-tight">
          {{ $locale == 'id' ? $article->title_id : $article->title_en }}
        </h1>

        {{-- Meta --}}
        <div class="flex items-center gap-3 text-sm text-muted mb-8 pb-6 border-b border-border">
          @if($article->meta_location_id)
            <span class="flex items-center gap-1">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
              {{ $locale == 'id' ? $article->meta_location_id : $article->meta_location_en }}
            </span>
            <span>•</span>
          @endif
          @if($article->published_at)
            <span class="flex items-center gap-1">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
              {{ $article->published_at->format('M d, Y') }}
            </span>
          @endif
        </div>

        {{-- Featured Image --}}
        @if($article->featured_image_url)
          <img src="{{ $article->featured_image_url }}" alt="{{ $locale == 'id' ? $article->title_id : $article->title_en }}" class="w-full rounded-2xl mb-8 object-cover" style="max-height: 450px;" />
        @endif

        {{-- Article Body --}}
        <article class="prose prose-lg max-w-none">
          @if($locale == 'id')
            {!! $article->content_id !!}
          @else
            {!! $article->content_en !!}
          @endif
        </article>

        {{-- Back Link --}}
        <div class="mt-12 pt-8 border-t border-border">
          <a href="/{{ $locale }}/news" class="inline-flex items-center gap-2 text-primary hover:text-cta font-medium transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            {{ $locale == 'id' ? 'Kembali ke Berita' : 'Back to News' }}
          </a>
        </div>
      </div>

      {{-- Sidebar --}}
      <aside class="hidden lg:block w-80 flex-shrink-0">
        <div class="article-sidebar">
          <h3 class="font-heading text-lg font-bold text-text mb-4 pb-3 border-b border-border">
            {{ $locale == 'id' ? 'Berita Lainnya' : 'Other News' }}
          </h3>
          <div class="space-y-6">
            @foreach($sidebarArticles as $item)
              <a href="/{{ $locale }}/news/{{ $item->slug }}" class="block group">
                @if($item->featured_image_url)
                  <img src="{{ $item->featured_image_url }}" alt="{{ $locale == 'id' ? $item->title_id : $item->title_en }}" class="w-full h-36 object-cover rounded-xl mb-3 group-hover:opacity-80 transition-opacity" />
                @endif
                <p class="text-xs text-primary uppercase tracking-wider mb-1">{{ ucfirst($item->category) }}</p>
                <h4 class="font-heading text-base font-semibold text-text group-hover:text-primary transition-colors leading-snug">
                  {{ $locale == 'id' ? $item->title_id : $item->title_en }}
                </h4>
                <p class="text-xs text-muted mt-1">
                  {{ $item->published_at ? $item->published_at->format('M d, Y') : $item->created_at->format('M d, Y') }}
                </p>
              </a>
            @endforeach
          </div>
        </div>
      </aside>

    </div>
  </div>
</div>
@endsection

@push('styles')
<style>
.prose h2 { font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 700; color: #0F1117; margin: 2rem 0 1rem; }
.prose h3 { font-family: 'Playfair Display', serif; font-size: 1.25rem; font-weight: 600; color: #0F1117; margin: 1.5rem 0 0.75rem; }
.prose p { font-size: 1rem; line-height: 1.8; color: #374151; margin-bottom: 1.25rem; }
.prose img { width: 100%; height: auto; border-radius: 12px; margin: 1.5rem 0; }
.prose ul { margin: 1rem 0 1.5rem 1.5rem; list-style: disc; }
.prose ul li { font-size: 1rem; line-height: 1.7; color: #374151; margin-bottom: 0.5rem; list-style: disc; }
.prose ol { margin: 1rem 0 1.5rem 1.5rem; list-style: decimal; }
.prose ol li { font-size: 1rem; line-height: 1.7; color: #374151; margin-bottom: 0.5rem; list-style: decimal; }
.prose blockquote { border-left: 4px solid #2B3984; padding: 1rem 1.5rem; margin: 1.5rem 0; background: #F8F6F1; border-radius: 0 12px 12px 0; }
.prose blockquote p { margin: 0; font-style: italic; }
.prose a { color: #2B3984; text-decoration: underline; }
.prose a:hover { color: #F97316; }
.prose strong { font-weight: 600; }
.prose video { width: 100%; border-radius: 12px; margin: 1.5rem 0; }
.prose iframe { width: 100%; border-radius: 12px; margin: 1.5rem 0; }
</style>
@endpush