@extends('layouts.public')

@php
function extractYouTubeId($url) {
  $patterns = [
    '/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([a-zA-Z0-9_-]{11})/',
    '/youtube\.com\/shorts\/([a-zA-Z0-9_-]{11})/'
  ];
  foreach ($patterns as $pattern) {
    if (preg_match($pattern, $url, $matches)) return $matches[1];
  }
  return null;
}
@endphp

@section('title', trans_for('publications.title', $locale) . ' | InaBCRU')
@section('description', trans_for('publications.subtitle', $locale))

@section('content')
{{-- Hero Section --}}
<section class="relative min-h-[50svh] flex items-center justify-start overflow-hidden">
  <div class="absolute inset-0">
    <img src="{{ $siteImages['hero_publications']->image_url ?? '/images/Field activity/IMG_6290.webp' }}" alt="{{ $siteImages['hero_publications']->alt_text ?? 'Publications' }}" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-dark/70"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-dark/60 via-transparent to-transparent"></div>
  </div>
  <div class="relative z-10 max-w-6xl mx-auto px-6 lg:px-8">
    <div class="animate-fade-up opacity-0">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-white/60 mb-4">

      </p>
      <h1 class="font-heading text-4xl md:text-5xl font-bold tracking-[-0.02em] mb-4 text-white">
        {{ trans_for('publications.title', $locale) }}
      </h1>
      <p class="text-white/70 text-lg max-w-2xl">
        {{ trans_for('publications.subtitle', $locale) }}
      </p>
    </div>
  </div>
</section>

{{-- Sections with Carousels --}}
@if($sections->count() > 0)
  @foreach($sections as $sectionIndex => $section)
    @if($section->publications->count() > 0)
    <section class="py-16 {{ $sectionIndex % 2 == 0 ? 'bg-background' : 'bg-surface-warm' }}">
      <div class="max-w-6xl mx-auto px-6 lg:px-8">
        <h2 class="font-heading text-2xl md:text-3xl font-bold text-text mb-8 flex items-center gap-3">
          <span class="w-1 h-8 bg-primary rounded-full"></span>
          {{ $locale == 'id' ? $section->title_id : $section->title_en }}
        </h2>

        <div class="relative flex items-center">
          @if($section->publications->count() > 1)
          <button onclick="scrollCarousel('{{ $sectionIndex }}', -1)" class="absolute left-0 z-10 w-8 h-8 bg-white/90 rounded-full shadow-md flex items-center justify-center text-primary hover:bg-white transition-colors cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
          </button>
          @endif
          <div class="carousel-container flex-1 overflow-x-auto pb-4 scrollbar-hide mx-8" data-carousel-id="{{ $sectionIndex }}" data-auto-slide="{{ $section->publications->count() > 1 ? 'true' : 'false' }}">
            <div class="flex gap-6" style="width: max-content;">
              @foreach($section->publications as $idx => $pub)
                @php
                $contentBlocks = is_array($pub->content_blocks) ? $pub->content_blocks : json_decode($pub->content_blocks ?? '[]', true);
                @endphp
                <div class="flex-shrink-0 w-80 bg-white rounded-2xl overflow-hidden border border-border hover:shadow-lg transition-shadow duration-300 cursor-pointer" @if(count($contentBlocks) > 0) onclick="openPreviewModal('{{ $sectionIndex }}_{{ $idx }}')" @elseif($pub->doi) onclick="window.open('{{ $pub->doi }}', '_blank')" @endif>
                  @if($pub->cover_image_url)
                    <div class="aspect-video overflow-hidden relative group">
                      <img src="{{ $pub->cover_image_url }}" alt="{{ $locale == 'id' ? $pub->title_id : $pub->title_en }}" class="w-full h-full object-cover">
                      <div class="absolute inset-0 bg-dark/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <div class="bg-white/90 rounded-full p-3">
                          <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                          </svg>
                        </div>
                      </div>
                    </div>
                  @else
                    <div class="aspect-video bg-gray-100 flex items-center justify-center">
                      <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                      </svg>
                    </div>
                  @endif
                  <div class="p-5">
                    @if($pub->year)
                      <p class="text-muted text-xs mb-2">{{ $pub->year }}</p>
                    @endif
                    <h3 class="font-heading text-base font-semibold text-text mb-2 line-clamp-2">
                      {{ $locale == 'id' ? $pub->title_id : $pub->title_en }}
                    </h3>
                    @if($pub->journal)
                      <p class="text-primary text-sm font-medium">{{ $pub->journal }}</p>
                    @endif
                    @if($pub->doi)
                      <a href="{{ $pub->doi }}" target="_blank" class="text-sm text-primary hover:underline mt-2 inline-block">
                        {{ $locale == 'id' ? 'Baca selengkapnya' : 'Read more' }} →
                      </a>
                    @endif
                  </div>
                </div>

                @php
                $contentBlocks = is_array($pub->content_blocks) ? $pub->content_blocks : json_decode($pub->content_blocks ?? '[]', true);
                @endphp

                @if(count($contentBlocks) > 0)
                <div id="preview-modal-{{ $sectionIndex }}_{{ $idx }}" class="fixed inset-0 z-50 hidden">
                  <div class="absolute inset-0 bg-dark/80 backdrop-blur-sm" onclick="closePreviewModal('{{ $sectionIndex }}_{{ $idx }}')"></div>
                  <div class="absolute inset-4 md:inset-8 lg:inset-16 bg-surface-warm rounded-2xl shadow-2xl overflow-hidden flex flex-col">
                    <div class="flex items-center justify-between p-4 border-b border-border flex-shrink-0">
                      <h3 class="font-heading text-lg font-semibold text-text">{{ $locale == 'id' ? $pub->title_id : $pub->title_en }}</h3>
                      <button onclick="closePreviewModal('{{ $sectionIndex }}_{{ $idx }}')" class="p-2 hover:bg-gray-100 rounded-lg transition-colors cursor-pointer">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></svg>
                        </svg>
                      </button>
                    </div>

                    <div class="flex-1 relative overflow-hidden">
                      <div id="preview-content-{{ $sectionIndex }}_{{ $idx }}" class="w-full h-full">
                        @foreach($contentBlocks as $blockIdx => $block)
                          <div class="preview-slide absolute inset-0 transition-opacity duration-300 {{ $blockIdx == 0 ? 'opacity-100' : 'opacity-0' }}" data-index="{{ $blockIdx }}" data-type="{{ $block['type'] ?? '' }}">
                            @if($block['type'] == 'youtube' && !empty($block['url']))
                              @php $youtubeId = extractYouTubeId($block['url']); @endphp
                              @if($youtubeId)
                                <div class="w-full h-full bg-dark flex items-center justify-center">
                                  <iframe data-src="https://www.youtube.com/embed/{{ $youtubeId }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                                </div>
                              @endif
                            @elseif($block['type'] == 'pdf')
                              <iframe src="{{ $block['url'] }}" class="w-full h-full" title="PDF Preview" style="display: block; width: 100%; height: 100%;"></iframe>
                            @elseif($block['type'] == 'video')
                              <div class="w-full h-full bg-dark flex items-center justify-center">
                                <video controls class="max-w-full max-h-full">
                                  <source src="{{ $block['url'] }}" type="video/mp4">
                                </video>
                              </div>
                            @elseif($block['type'] == 'image')
                              <img src="{{ $block['url'] }}" alt="Preview" class="w-full h-full object-contain">
                            @endif
                          </div>
                        @endforeach
                      </div>

                      @if(count($contentBlocks) > 1)
                      <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-3 bg-dark/50 backdrop-blur-sm rounded-full px-4 py-2">
                        <button onclick="switchSlide('{{ $sectionIndex }}_{{ $idx }}', -1)" class="p-1.5 hover:bg-white/20 rounded-full transition-colors cursor-pointer">
                          <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                          </svg>
                        </button>
                        <span id="slide-counter-{{ $sectionIndex }}_{{ $idx }}" class="text-white text-xs font-medium px-2">1 / {{ count($contentBlocks) }}</span>
                        <div class="flex gap-1">
                          @foreach($contentBlocks as $blockIdx => $block)
                            <button onclick="goToSlide('{{ $sectionIndex }}_{{ $idx }}', {{ $blockIdx }})" class="w-2 h-2 rounded-full transition-colors {{ $blockIdx == 0 ? 'bg-white' : 'bg-white/40 hover:bg-white/60' }} cursor-pointer"></button>
                          @endforeach
                        </div>
                        <button onclick="switchSlide('{{ $sectionIndex }}_{{ $idx }}', 1)" class="p-1.5 hover:bg-white/20 rounded-full transition-colors cursor-pointer">
                          <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                          </svg>
                        </button>
                      </div>
                      @endif
                    </div>
                  </div>
                </div>
                @endif
              @endforeach
            </div>
          </div>
          @if($section->publications->count() > 1)
          <button onclick="scrollCarousel('{{ $sectionIndex }}', 1)" class="absolute right-0 z-10 w-8 h-8 bg-white/90 rounded-full shadow-md flex items-center justify-center text-primary hover:bg-white transition-colors cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
          </button>
          @endif
        </div>
      </div>
    </section>
    @endif
  @endforeach
@endif

{{-- Fallback: If no sections, show all publications in grid --}}
@if($sections->count() == 0 && $publications->count() > 0)
<section class="py-24 bg-background">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      @foreach($publications as $idx => $pub)
        <div class="bg-surface-warm rounded-2xl overflow-hidden border border-border hover:shadow-lg transition-shadow duration-300 animate-fade-up opacity-0 cursor-pointer" style="animation-delay: {{ ($idx + 1) * 0.1 }}s;" onclick="openPreviewModal('ungrouped_{{ $idx }}')">
          @if($pub->cover_image_url)
            <div class="aspect-video overflow-hidden relative group">
              <img src="{{ $pub->cover_image_url }}" alt="{{ $locale == 'id' ? $pub->title_id : $pub->title_en }}" class="w-full h-full object-cover">
              <div class="absolute inset-0 bg-dark/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                <div class="bg-white/90 rounded-full p-3">
                  <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                  </svg>
                </div>
              </div>
            </div>
          @endif
          <div class="p-6">
            @if($pub->year)
              <p class="text-muted text-xs mb-2">{{ $pub->year }}</p>
            @endif
            <h3 class="font-heading text-lg font-semibold text-text mb-2 line-clamp-2">
              {{ $locale == 'id' ? $pub->title_id : $pub->title_en }}
            </h3>
            @if($pub->journal)
              <p class="text-primary text-sm font-medium">{{ $pub->journal }}</p>
            @endif
            @if($pub->doi)
              <a href="{{ $pub->doi }}" target="_blank" class="text-sm text-primary hover:underline mt-2 inline-block">
                {{ $locale == 'id' ? 'Baca selengkapnya' : 'Read more' }} →
              </a>
            @endif
          </div>
        </div>

        @php
        $contentBlocks = is_array($pub->content_blocks) ? $pub->content_blocks : json_decode($pub->content_blocks ?? '[]', true);
        @endphp

        @if(count($contentBlocks) > 0)
        <div id="preview-modal-ungrouped_{{ $idx }}" class="fixed inset-0 z-50 hidden">
          <div class="absolute inset-0 bg-dark/80 backdrop-blur-sm" onclick="closePreviewModal('ungrouped_{{ $idx }}')"></div>
          <div class="absolute inset-4 md:inset-8 lg:inset-16 bg-surface-warm rounded-2xl shadow-2xl overflow-hidden flex flex-col">
            <div class="flex items-center justify-between p-4 border-b border-border flex-shrink-0">
              <h3 class="font-heading text-lg font-semibold text-text">{{ $locale == 'id' ? $pub->title_id : $pub->title_en }}</h3>
              <button onclick="closePreviewModal('ungrouped_{{ $idx }}')" class="p-2 hover:bg-gray-100 rounded-lg transition-colors cursor-pointer">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></svg>
                </svg>
              </button>
            </div>

            <div class="flex-1 relative overflow-hidden">
              <div id="preview-content-ungrouped_{{ $idx }}" class="w-full h-full">
                @foreach($contentBlocks as $blockIdx => $block)
                  <div class="preview-slide absolute inset-0 transition-opacity duration-300 {{ $blockIdx == 0 ? 'opacity-100' : 'opacity-0' }}" data-index="{{ $blockIdx }}" data-type="{{ $block['type'] ?? '' }}">
                    @if($block['type'] == 'youtube' && !empty($block['url']))
                      @php $youtubeId = extractYouTubeId($block['url']); @endphp
                      @if($youtubeId)
                        <div class="w-full h-full bg-dark flex items-center justify-center">
                          <iframe data-src="https://www.youtube.com/embed/{{ $youtubeId }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                        </div>
                      @endif
                    @elseif($block['type'] == 'pdf')
                      <iframe src="{{ $block['url'] }}" class="w-full h-full" title="PDF Preview" style="display: block; width: 100%; height: 100%;"></iframe>
                    @elseif($block['type'] == 'video')
                      <div class="w-full h-full bg-dark flex items-center justify-center">
                        <video controls class="max-w-full max-h-full">
                          <source src="{{ $block['url'] }}" type="video/mp4">
                        </video>
                      </div>
                    @elseif($block['type'] == 'image')
                      <img src="{{ $block['url'] }}" alt="Preview" class="w-full h-full object-contain">
                    @endif
                  </div>
                @endforeach
              </div>

              @if(count($contentBlocks) > 1)
              <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-3 bg-dark/50 backdrop-blur-sm rounded-full px-4 py-2">
                <button onclick="switchSlide('ungrouped_{{ $idx }}', -1)" class="p-1.5 hover:bg-white/20 rounded-full transition-colors cursor-pointer">
                  <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                  </svg>
                </button>
                <span id="slide-counter-ungrouped_{{ $idx }}" class="text-white text-xs font-medium px-2">1 / {{ count($contentBlocks) }}</span>
                <div class="flex gap-1">
                  @foreach($contentBlocks as $blockIdx => $block)
                    <button onclick="goToSlide('ungrouped_{{ $idx }}', {{ $blockIdx }})" class="w-2 h-2 rounded-full transition-colors {{ $blockIdx == 0 ? 'bg-white' : 'bg-white/40 hover:bg-white/60' }} cursor-pointer"></button>
                  @endforeach
                </div>
                <button onclick="switchSlide('ungrouped_{{ $idx }}', 1)" class="p-1.5 hover:bg-white/20 rounded-full transition-colors cursor-pointer">
                  <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </button>
              </div>
              @endif
            </div>
          </div>
        </div>
        @endif
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- Empty State --}}
@if($sections->count() == 0 && $publications->count() == 0)
<section class="py-24 bg-background">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="text-center py-16">
      <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
      </svg>
      <p class="text-muted">{{ $locale == 'id' ? 'Belum ada publikasi' : 'No publications yet' }}</p>
    </div>
  </div>
</section>
@endif

<style>
.scrollbar-hide::-webkit-scrollbar {
  display: none;
}
.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
.carousel-container {
  scroll-behavior: smooth;
  -webkit-overflow-scrolling: touch;
}
.carousel-container::-webkit-scrollbar {
  display: none;
}
</style>

<script>
let currentSlide = {};

function openPreviewModal(modalId) {
  const modal = document.getElementById('preview-modal-' + modalId);
  if (modal) {
    modal.classList.remove('hidden');
    currentSlide[modalId] = 0;
    updateSlides(modalId);
    updateSlideIndicator(modalId);
    activateSlide(modalId, 0);
  }
}

function closePreviewModal(modalId) {
  const modal = document.getElementById('preview-modal-' + modalId);
  if (modal) {
    const slide = modal.querySelector('.preview-slide[data-index="' + (currentSlide[modalId] || 0) + '"]');
    if (slide) {
      const type = slide.dataset.type;
      if (type === 'youtube') {
        const iframe = slide.querySelector('iframe');
        if (iframe) iframe.src = '';
      } else if (type === 'video') {
        const video = slide.querySelector('video');
        if (video) video.pause();
      }
    }
    modal.classList.add('hidden');
  }
}

function activateSlide(modalId, slideIdx) {
  const modal = document.getElementById('preview-modal-' + modalId);
  if (!modal) return;

  const slide = modal.querySelector('.preview-slide[data-index="' + slideIdx + '"]');
  if (!slide) return;

  const type = slide.dataset.type;
  const iframe = slide.querySelector('iframe');

  if (iframe && type !== 'pdf') {
    if (!iframe.src) {
      iframe.src = iframe.dataset.src;
    }
  } else if (iframe && type === 'pdf' && !iframe.src) {
    iframe.src = iframe.dataset.src;
  }
}

function switchSlide(modalId, direction) {
  const modal = document.getElementById('preview-modal-' + modalId);
  if (!modal) return;

  const slides = modal.querySelectorAll('.preview-slide');
  if (slides.length === 0) return;

  const oldSlide = modal.querySelector('.preview-slide[data-index="' + currentSlide[modalId] + '"]');
  if (oldSlide) {
    const oldType = oldSlide.dataset.type;
    if (oldType == 'video') {
      const video = oldSlide.querySelector('video');
      if (video) video.pause();
    }
  }

  currentSlide[modalId] = (currentSlide[modalId] + direction + slides.length) % slides.length;
  updateSlides(modalId);
  updateSlideIndicator(modalId);
  activateSlide(modalId, currentSlide[modalId]);
}

function goToSlide(modalId, slideIdx) {
  const modal = document.getElementById('preview-modal-' + modalId);
  if (!modal) return;

  const oldSlide = modal.querySelector('.preview-slide[data-index="' + currentSlide[modalId] + '"]');
  if (oldSlide) {
    const oldType = oldSlide.dataset.type;
    if (oldType == 'video') {
      const video = oldSlide.querySelector('video');
      if (video) video.pause();
    }
  }

  currentSlide[modalId] = slideIdx;
  updateSlides(modalId);
  updateSlideIndicator(modalId);
  activateSlide(modalId, currentSlide[modalId]);
}

function updateSlides(modalId) {
  const modal = document.getElementById('preview-modal-' + modalId);
  if (!modal) return;

  const slides = modal.querySelectorAll('.preview-slide');
  slides.forEach((slide, i) => {
    if (i === currentSlide[modalId]) {
      slide.classList.remove('opacity-0');
      slide.classList.add('opacity-100');
      slide.style.pointerEvents = 'auto';
    } else {
      slide.classList.remove('opacity-100');
      slide.classList.add('opacity-0');
      slide.style.pointerEvents = 'none';
    }
  });
}

function updateSlideIndicator(modalId) {
  const modal = document.getElementById('preview-modal-' + modalId);
  if (!modal) return;

  const counter = document.getElementById('slide-counter-' + modalId);
  const slides = modal.querySelectorAll('.preview-slide');
  if (counter && slides.length > 0) {
    counter.textContent = (currentSlide[modalId] + 1) + ' / ' + slides.length;
  }

  const dots = modal.querySelectorAll('.flex.gap-1 button');
  dots.forEach((dot, i) => {
    if (i === currentSlide[modalId]) {
      dot.classList.remove('bg-white/40', 'hover:bg-white/60');
      dot.classList.add('bg-white');
    } else {
      dot.classList.remove('bg-white');
      dot.classList.add('bg-white/40', 'hover:bg-white/60');
    }
  });
}

function scrollCarousel(sectionIndex, direction) {
  const container = document.querySelector(`[data-carousel-id="${sectionIndex}"]`);
  if (!container) return;

  const cardWidth = 344;
  const newScrollLeft = container.scrollLeft + (direction * cardWidth);
  container.scrollTo({
    left: newScrollLeft,
    behavior: 'smooth'
  });
}

function initAutoSlide() {
  document.querySelectorAll('.carousel-container[data-auto-slide="true"]').forEach(container => {
    let autoSlideInterval;
    let isPaused = false;

    function autoScroll() {
      const maxScroll = container.scrollWidth - container.clientWidth;
      if (container.scrollLeft >= maxScroll - 10) {
        container.scrollTo({ left: 0, behavior: 'smooth' });
      } else {
        container.scrollBy({ left: 340, behavior: 'smooth' });
      }
    }

    container.addEventListener('mouseenter', () => { isPaused = true; });
    container.addEventListener('mouseleave', () => { isPaused = false; });
    container.addEventListener('touchstart', () => { isPaused = true; });
    container.addEventListener('touchend', () => { setTimeout(() => { isPaused = false; }, 2000); });

    autoSlideInterval = setInterval(() => {
      if (!isPaused) {
        autoScroll();
      }
    }, 5000);
  });
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initAutoSlide);
} else {
  initAutoSlide();
}

document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    document.querySelectorAll('[id^="preview-modal-"]').forEach(modal => {
      const modalId = modal.id.replace('preview-modal-', '');
      const slide = modal.querySelector('.preview-slide[data-index="' + (currentSlide[modalId] || 0) + '"]');
      if (slide) {
        const type = slide.dataset.type;
        if (type == 'youtube') {
          const iframe = slide.querySelector('iframe');
          if (iframe) iframe.src = '';
        } else if (type == 'video') {
          const video = slide.querySelector('video');
          if (video) video.pause();
        }
      }
      modal.classList.add('hidden');
    });
  }
});
</script>
@endsection