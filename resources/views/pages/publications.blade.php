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
        {{ $locale == 'id' ? 'Publikasi' : 'Publications' }}
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

{{-- Publications Section --}}
<section class="py-24 bg-background">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    @if($publications->isEmpty())
      <div class="text-center py-16">
        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
        </svg>
        <p class="text-muted">{{ $locale == 'id' ? 'Belum ada publikasi' : 'No publications yet' }}</p>
      </div>
    @else
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
        @foreach($publications as $idx => $pub)
          <div class="bg-surface-warm rounded-2xl overflow-hidden border border-border hover:shadow-lg transition-shadow duration-300 animate-fade-up opacity-0 cursor-pointer" style="animation-delay: {{ ($idx + 1) * 0.1 }}s;" onclick="openPreviewModal({{ $idx }})">
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
          <div id="preview-modal-{{ $idx }}" class="fixed inset-0 z-50 hidden">
            <div class="absolute inset-0 bg-dark/80 backdrop-blur-sm" onclick="closePreviewModal({{ $idx }})"></div>
            <div class="absolute inset-4 md:inset-8 lg:inset-16 bg-surface-warm rounded-2xl shadow-2xl overflow-hidden flex flex-col">
              <div class="flex items-center justify-between p-4 border-b border-border flex-shrink-0">
                <h3 class="font-heading text-lg font-semibold text-text">{{ $locale == 'id' ? $pub->title_id : $pub->title_en }}</h3>
                <button onclick="closePreviewModal({{ $idx }})" class="p-2 hover:bg-gray-100 rounded-lg transition-colors cursor-pointer">
                  <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                  </svg>
                </button>
              </div>

              <div class="flex-1 relative overflow-hidden">
                <div id="preview-content-{{ $idx }}" class="w-full h-full">
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
                        <iframe data-src="{{ $block['url'] }}" class="w-full h-full" title="PDF Preview"></iframe>
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
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-2 bg-dark/50 backdrop-blur-sm rounded-full px-4 py-2">
                  <button onclick="switchSlide({{ $idx }}, -1)" class="p-2 hover:bg-white/20 rounded-full transition-colors cursor-pointer">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                  </button>
                  <div class="flex gap-1">
                    @foreach($contentBlocks as $blockIdx => $block)
                      <button onclick="goToSlide({{ $idx }}, {{ $blockIdx }})" class="w-2 h-2 rounded-full transition-colors {{ $blockIdx == 0 ? 'bg-white' : 'bg-white/40 hover:bg-white/60' }} cursor-pointer"></button>
                    @endforeach
                  </div>
                  <button onclick="switchSlide({{ $idx }}, 1)" class="p-2 hover:bg-white/20 rounded-full transition-colors cursor-pointer">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </button>
                </div>
                @endif

                <div class="absolute top-1/2 -translate-y-1/2 left-2">
                  <div class="bg-dark/50 backdrop-blur-sm rounded-full px-3 py-1 text-xs text-white">
                    <span id="slide-counter-{{ $idx }}">1 / {{ count($contentBlocks) }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif
        @endforeach
      </div>
    @endif
  </div>
</section>

<script>
let currentSlide = {};

function openPreviewModal(idx) {
  const modal = document.getElementById('preview-modal-' + idx);
  if (modal) {
    modal.classList.remove('hidden');
    currentSlide[idx] = 0;
    updateSlideIndicator(idx);
    activateSlide(idx, 0);
  }
}

function closePreviewModal(idx) {
  const modal = document.getElementById('preview-modal-' + idx);
  if (modal) {
    const slide = modal.querySelector('.preview-slide[data-index="' + currentSlide[idx] + '"]');
    if (slide && slide.dataset.type == 'youtube') {
      const iframe = slide.querySelector('iframe');
      if (iframe) iframe.src = '';
    } else if (slide && slide.dataset.type == 'video') {
      const video = slide.querySelector('video');
      if (video) video.pause();
    }
    modal.classList.add('hidden');
  }
}

function activateSlide(idx, slideIdx) {
  const modal = document.getElementById('preview-modal-' + idx);
  if (!modal) return;
  
  const slide = modal.querySelector('.preview-slide[data-index="' + slideIdx + '"]');
  if (!slide) return;
  
  const type = slide.dataset.type;
  if (type == 'youtube' || type == 'pdf') {
    const iframe = slide.querySelector('iframe');
    if (iframe && !iframe.src) {
      iframe.src = iframe.dataset.src;
    }
  }
}

function switchSlide(idx, direction) {
  const modal = document.getElementById('preview-modal-' + idx);
  if (!modal) return;

  const slides = modal.querySelectorAll('.preview-slide');
  if (slides.length === 0) return;

  const oldSlide = modal.querySelector('.preview-slide[data-index="' + currentSlide[idx] + '"]');
  if (oldSlide) {
    const oldType = oldSlide.dataset.type;
    if (oldType == 'youtube') {
      const iframe = oldSlide.querySelector('iframe');
      if (iframe) iframe.src = '';
    } else if (oldType == 'video') {
      const video = oldSlide.querySelector('video');
      if (video) video.pause();
    }
  }

  currentSlide[idx] = (currentSlide[idx] + direction + slides.length) % slides.length;
  updateSlides(idx);
  updateSlideIndicator(idx);
  activateSlide(idx, currentSlide[idx]);
}

function goToSlide(idx, slideIdx) {
  const modal = document.getElementById('preview-modal-' + idx);
  if (!modal) return;

  const oldSlide = modal.querySelector('.preview-slide[data-index="' + currentSlide[idx] + '"]');
  if (oldSlide) {
    const oldType = oldSlide.dataset.type;
    if (oldType == 'youtube') {
      const iframe = oldSlide.querySelector('iframe');
      if (iframe) iframe.src = '';
    } else if (oldType == 'video') {
      const video = oldSlide.querySelector('video');
      if (video) video.pause();
    }
  }

  currentSlide[idx] = slideIdx;
  updateSlides(idx);
  updateSlideIndicator(idx);
  activateSlide(idx, currentSlide[idx]);
}

function updateSlides(idx) {
  const modal = document.getElementById('preview-modal-' + idx);
  if (!modal) return;

  const slides = modal.querySelectorAll('.preview-slide');
  slides.forEach((slide, i) => {
    if (i === currentSlide[idx]) {
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

function updateSlideIndicator(idx) {
  const modal = document.getElementById('preview-modal-' + idx);
  if (!modal) return;

  const counter = document.getElementById('slide-counter-' + idx);
  const slides = modal.querySelectorAll('.preview-slide');
  if (counter && slides.length > 0) {
    counter.textContent = (currentSlide[idx] + 1) + ' / ' + slides.length;
  }

  const dots = modal.querySelectorAll('.flex.gap-1 button');
  dots.forEach((dot, i) => {
    if (i === currentSlide[idx]) {
      dot.classList.remove('bg-white/40', 'hover:bg-white/60');
      dot.classList.add('bg-white');
    } else {
      dot.classList.remove('bg-white');
      dot.classList.add('bg-white/40', 'hover:bg-white/60');
    }
  });
}

document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    document.querySelectorAll('[id^="preview-modal-"]').forEach(modal => {
      const idx = modal.id.replace('preview-modal-', '');
      const slide = modal.querySelector('.preview-slide[data-index="' + currentSlide[idx] + '"]');
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