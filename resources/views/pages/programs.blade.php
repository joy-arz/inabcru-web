@extends('layouts.public')

@section('title', trans_for('nav.programs', $locale) . ' | InaBCRU')
@section('description', trans_for('programs.subtitle', $locale))

@section('content')
{{-- Hero Section --}}
<section class="relative min-h-[50svh] flex items-center justify-start overflow-hidden">
  <div class="absolute inset-0">
    <img src="{{ $siteImages['hero_programs']->image_url ?? '/images/Field activity/IMG_2226.webp' }}" alt="{{ $siteImages['hero_programs']->alt_text ?? 'Conservation programs' }}" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-dark/70"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-dark/60 via-transparent to-transparent"></div>
  </div>
  <div class="relative z-10 max-w-6xl mx-auto px-6 lg:px-8">
    <div class="animate-fade-up opacity-0">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-white/60 mb-4">
        
      </p>
      <h1 class="font-heading text-4xl md:text-5xl font-bold tracking-[-0.02em] mb-4 text-white">
        {{ trans_for('programs.title', $locale) }}
      </h1>
      <p class="text-white/70 text-lg max-w-2xl">
        {{ trans_for('programs.subtitle', $locale) }}
      </p>
    </div>
  </div>
</section>

{{-- Programs Grid Section --}}
<section class="py-16 bg-background">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    @foreach($divisions as $divisionIndex => $division)
      @if($division->programs->count() > 0)
      <div class="mb-16">
        <h2 class="font-heading text-2xl font-bold text-text mb-8 pb-4 border-b border-border">
          {{ $locale == 'id' ? $division->name_id : $division->name_en }}
        </h2>

        <div class="relative flex items-center">
          @if($division->programs->count() > 1)
          <button onclick="scrollCarousel('division_{{ $divisionIndex }}', -1)" class="absolute left-0 z-10 w-8 h-8 bg-white/90 rounded-full shadow-md flex items-center justify-center text-primary hover:bg-white transition-colors cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
          </button>
          @endif
          <div class="carousel-container flex-1 overflow-x-auto pb-4 scrollbar-hide mx-8" data-carousel-id="division_{{ $divisionIndex }}" data-auto-slide="{{ $division->programs->count() > 1 ? 'true' : 'false' }}">
            <div class="flex gap-6" style="width: max-content;">
              @foreach($division->programs as $program)
                <div class="w-80 flex-shrink-0 bg-surface-warm rounded-2xl p-8 border border-border group hover:shadow-lg transition-shadow duration-300 cursor-pointer" onclick="openProgramModal({{ $program->id }})">
                  <div class="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                    @if($program->icon)
                      <i class="{{ $program->icon }} text-xl"></i>
                    @else
                      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    @endif
                  </div>
                  <h3 class="font-heading text-xl font-semibold text-text mb-3">
                    {{ $locale == 'id' ? $program->title_id : $program->title_en }}
                  </h3>
                  <p class="text-muted leading-relaxed">
                    {{ $locale == 'id' ? $program->short_description_id : $program->short_description_en }}
                  </p>
                </div>
              @endforeach
            </div>
          </div>
          @if($division->programs->count() > 1)
          <button onclick="scrollCarousel('division_{{ $divisionIndex }}', 1)" class="absolute right-0 z-10 w-8 h-8 bg-white/90 rounded-full shadow-md flex items-center justify-center text-primary hover:bg-white transition-colors cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
          </button>
          @endif
        </div>
      </div>
      @endif
    @endforeach

    @if($divisions->isEmpty() || $divisions->every(fn($d) => $d->programs->count() == 0))
      <div class="text-center py-16">
        <p class="text-muted">{{ $locale == 'id' ? 'Belum ada program' : 'No programs yet' }}</p>
      </div>
    @endif
  </div>
</section>

{{-- Program Modal --}}
<div id="programModal" class="fixed inset-0 z-50 hidden">
  <div class="absolute inset-0 bg-dark/80" onclick="closeProgramModal()"></div>
  <div class="relative z-10 max-w-4xl mx-auto my-8 max-h-[calc(100vh-4rem)] overflow-y-auto">
    <div class="bg-background rounded-2xl overflow-hidden">
      <button onclick="closeProgramModal()" class="absolute top-4 right-4 z-20 w-10 h-10 bg-white/90 rounded-full flex items-center justify-center text-gray-600 hover:text-gray-900 cursor-pointer shadow-lg">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
      </button>
      <div id="programModalContent"></div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<style>
.scrollbar-hide::-webkit-scrollbar { display: none; }
.scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
.carousel-container { scroll-behavior: smooth; -webkit-overflow-scrolling: touch; }
.carousel-container::-webkit-scrollbar { display: none; }
</style>
<script>
const programs = @json($programsJson);

function scrollCarousel(sectionIndex, direction) {
  const container = document.querySelector(`[data-carousel-id="${sectionIndex}"]`);
  if (!container) return;

  const cardWidth = 344;
  const newScrollLeft = container.scrollLeft + (direction * cardWidth);
  container.scrollTo({ left: newScrollLeft, behavior: 'smooth' });
}

function initAutoSlide() {
  document.querySelectorAll('.carousel-container[data-auto-slide="true"]').forEach(container => {
    let autoSlideInterval;
    let isPaused = false;

    container.addEventListener('mouseenter', () => { isPaused = true; });
    container.addEventListener('mouseleave', () => { isPaused = false; });
    container.addEventListener('touchstart', () => { isPaused = true; });
    container.addEventListener('touchend', () => { setTimeout(() => { isPaused = false; }, 2000); });

    autoSlideInterval = setInterval(() => {
      if (!isPaused) {
        const maxScroll = container.scrollWidth - container.clientWidth;
        if (container.scrollLeft >= maxScroll - 10) {
          container.scrollTo({ left: 0, behavior: 'smooth' });
        } else {
          container.scrollBy({ left: 344, behavior: 'smooth' });
        }
      }
    }, 5000);
  });
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initAutoSlide);
} else {
  initAutoSlide();
}

function openProgramModal(id) {
  const program = programs.find(p => p.id === id);
  if (!program) return;

  const locale = '{{ $locale }}';
  const title = locale === 'id' ? program.title_id : program.title_en;
  const description = locale === 'id' ? program.description_id : program.description_en;
  const shortDesc = locale === 'id' ? program.short_description_id : program.short_description_en;

  let carouselHtml = '';
  if (program.carousel_images && program.carousel_images.length > 0) {
    carouselHtml = `
      <div class="mt-6">
        <h4 class="text-sm font-semibold text-gray-500 mb-3 uppercase tracking-wider">Documentation</h4>
        <div class="flex gap-3 overflow-x-auto pb-2">
          ${program.carousel_images.map(img => `
            <img src="${img}" alt="" class="h-40 w-auto rounded-lg flex-shrink-0 object-cover cursor-pointer hover:opacity-90 transition-opacity" onclick="window.open('${img}', '_blank')">
          `).join('')}
        </div>
      </div>
    `;
  }

  const content = `
    ${program.featured_image_url ? `<div class="relative aspect-video"><img src="${program.featured_image_url}" alt="${program.featured_image_alt || ''}" class="w-full h-full object-cover"></div>` : ''}
    <div class="p-8">
      <div class="flex items-center gap-4 mb-6">
        ${program.icon ? `<div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary"><i class="${program.icon} text-xl"></i></div>` : ''}
        <div>
          <h2 class="font-heading text-2xl font-bold text-text">${title}</h2>
          ${shortDesc ? `<p class="text-muted mt-1">${shortDesc}</p>` : ''}
        </div>
      </div>
      <div class="prose prose-sm max-w-none text-muted leading-relaxed">
        ${description || ''}
      </div>
      ${carouselHtml}
    </div>
  `;

  document.getElementById('programModalContent').innerHTML = content;
  document.getElementById('programModal').classList.remove('hidden');
  document.body.style.overflow = 'hidden';
}

function closeProgramModal() {
  document.getElementById('programModal').classList.add('hidden');
  document.body.style.overflow = '';
}

document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') closeProgramModal();
});
</script>
@endpush