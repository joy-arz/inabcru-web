@extends('layouts.public')

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

              <div class="flex-1 flex flex-col min-h-0">
                {{-- Panel container --}}
                <div id="panel-container-{{ $idx }}" class="flex-1 relative">
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
                  @foreach($contentBlocks as $blockIdx => $block)
                    <div id="slide-{{ $idx }}-{{ $blockIdx }}" class="slide-panel absolute inset-0 {{ $blockIdx === 0 ? '' : 'hidden' }}" data-type="{{ $block['type'] ?? '' }}">
                      @if($block['type'] === 'youtube' && !empty($block['url']))
                        @php $youtubeId = extractYouTubeId($block['url']); @endphp
                        @if($youtubeId)
                          <div class="w-full h-full bg-dark flex items-center justify-center">
                            <iframe id="youtube-{{ $idx }}-{{ $blockIdx }}" data-src="https://www.youtube.com/embed/{{ $youtubeId }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                          </div>
                        @endif
                      @elseif($block['type'] === 'pdf')
                        <iframe id="pdf-{{ $idx }}-{{ $blockIdx }}" data-src="{{ $block['url'] }}" class="w-full h-full" title="PDF Preview" style="overflow: auto;"></iframe>
                      @elseif($block['type'] === 'video')
                        <div class="w-full h-full bg-dark flex items-center justify-center">
                          <video id="video-{{ $idx }}-{{ $blockIdx }}" controls class="max-w-full max-h-full">
                            <source src="{{ $block['url'] }}" type="video/webm">
                          </video>
                        </div>
                      @elseif($block['type'] === 'image')
                        <img src="{{ $block['url'] }}" alt="Preview" class="w-full h-full object-contain">
                      @endif
                    </div>
                  @endforeach
                </div>

                {{-- Navigation controls --}}
                @if(count($contentBlocks) > 1)
                <div class="flex items-center justify-center gap-4 py-3 bg-gray-100 flex-shrink-0">
                  <button onclick="prevSlide({{ $idx }})" class="p-2 hover:bg-gray-200 rounded-full transition-colors cursor-pointer">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                  </button>
                  <div class="flex items-center gap-2">
                    @foreach($contentBlocks as $blockIdx => $block)
                      <button onclick="goToSlide({{ $idx }}, {{ $blockIdx }})" id="dot-{{ $idx }}-{{ $blockIdx }}" class="w-2.5 h-2.5 rounded-full transition-colors {{ $blockIdx === 0 ? 'bg-primary' : 'bg-gray-300 hover:bg-gray-400' }} cursor-pointer"></button>
                    @endforeach
                  </div>
                  <button onclick="nextSlide({{ $idx }})" class="p-2 hover:bg-gray-200 rounded-full transition-colors cursor-pointer">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </button>
                </div>
                @endif
              </div>
            </div>
          </div>
          @endif
                      @elseif($block['type'] === 'pdf')
                        <iframe data-src="{{ $block['url'] }}" class="w-full h-full" title="PDF Preview" style="overflow: auto; pointer-events: auto;"></iframe>
                      @elseif($block['type'] === 'video')
                        <div class="w-full h-full bg-dark flex items-center justify-center" style="pointer-events: auto;">
                          <video controls class="max-w-full max-h-full" style="pointer-events: auto;">
                            <source src="{{ $block['url'] }}" type="video/webm">
                          </video>
                        </div>
                      @elseif($block['type'] === 'image')
                        <img src="{{ $block['url'] }}" alt="Preview" class="w-full h-full object-contain" style="pointer-events: auto;">
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
                      <button onclick="goToSlide({{ $idx }}, {{ $blockIdx }})" class="w-2 h-2 rounded-full transition-colors {{ $blockIdx === 0 ? 'bg-white' : 'bg-white/40 hover:bg-white/60' }} cursor-pointer"></button>
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
let sliders = {}; // Track state per publication

function openPreviewModal(idx) {
  const modal = document.getElementById('preview-modal-' + idx);
  if (!modal) return;
  
  // Initialize slider state
  sliders[idx] = {
    current: 0,
    total: modal.querySelectorAll('.slide-panel').length
  };
  
  modal.classList.remove('hidden');
  activateSlide(idx, 0);
}

function closePreviewModal(idx) {
  const modal = document.getElementById('preview-modal-' + idx);
  if (!modal) return;
  
  // Deactivate current slide to stop playback
  const state = sliders[idx];
  if (state !== undefined) {
    deactivateSlide(idx, state.current);
  }
  
  modal.classList.add('hidden');
}

function prevSlide(idx) {
  const state = sliders[idx];
  if (!state) return;
  const newIndex = (state.current - 1 + state.total) % state.total;
  activateSlide(idx, newIndex);
}

function nextSlide(idx) {
  const state = sliders[idx];
  if (!state) return;
  const newIndex = (state.current + 1) % state.total;
  activateSlide(idx, newIndex);
}

function goToSlide(idx, slideIdx) {
  activateSlide(idx, slideIdx);
}

function activateSlide(idx, newIndex) {
  const state = sliders[idx];
  if (!state) return;
  
  // Deactivate old slide
  if (state.current !== newIndex) {
    deactivateSlide(idx, state.current);
  }
  
  // Activate new slide
  state.current = newIndex;
  
  const modal = document.getElementById('preview-modal-' + idx);
  if (!modal) return;
  
  // Hide all slides, show target
  modal.querySelectorAll('.slide-panel').forEach((panel, i) => {
    if (i === newIndex) {
      panel.classList.remove('hidden');
      // Activate based on type
      activatePanel(idx, i, panel.dataset.type);
    } else {
      panel.classList.add('hidden');
    }
  });
  
  // Update dots
  modal.querySelectorAll('[id^="dot-"]').forEach((dot, i) => {
    if (i === newIndex) {
      dot.classList.remove('bg-gray-300', 'hover:bg-gray-400');
      dot.classList.add('bg-primary');
    } else {
      dot.classList.remove('bg-primary');
      dot.classList.add('bg-gray-300', 'hover:bg-gray-400');
    }
  });
}

function deactivateSlide(idx, slideIndex) {
  const panel = document.getElementById('slide-' + idx + '-' + slideIndex);
  if (!panel) return;
  
  const type = panel.dataset.type;
  
  if (type === 'youtube') {
    const iframe = document.getElementById('youtube-' + idx + '-' + slideIndex);
    if (iframe) iframe.src = '';
  } else if (type === 'video') {
    const video = document.getElementById('video-' + idx + '-' + slideIndex);
    if (video) video.pause();
  }
}

function activatePanel(idx, slideIndex, type) {
  if (type === 'youtube') {
    const iframe = document.getElementById('youtube-' + idx + '-' + slideIndex);
    if (iframe && !iframe.src) {
      iframe.src = iframe.dataset.src;
    }
  }
  // Images and PDFs load immediately via src
}

document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    document.querySelectorAll('[id^="preview-modal-"]').forEach(modal => {
      const match = modal.id.match(/preview-modal-(\d+)/);
      if (match) closePreviewModal(parseInt(match[1]));
    });
  }
});
</script>
@endsection