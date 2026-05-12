@extends('layouts.public')

@section('title', trans_for('about.title') . ' | InaBCRU')
@section('description', trans_for('about.description'))

@section('content')
{{-- Hero Section --}}
<section class="pt-40 pb-20 relative overflow-hidden">
  <div class="absolute inset-0">
    <img src="/images/Field activity/IMG_2175.webp" alt="Indonesian forest landscape" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-dark/80"></div>
  </div>
  <div class="relative z-10 max-w-6xl mx-auto px-6 lg:px-8">
    <div class="animate-fade-up opacity-0">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-white/60 mb-4">
        {{ $locale == 'id' ? 'Tentang Kami' : 'About Us' }}
      </p>
      <h1 class="font-heading text-4xl md:text-5xl font-bold tracking-[-0.02em] mb-4 text-white">
        {{ trans_for('about.title') }}
      </h1>
      <p class="text-white/70 text-lg max-w-2xl">
        {{ trans_for('about.description') }}
      </p>
    </div>
  </div>
</section>

{{-- About Content Section --}}
<section class="py-24 bg-background">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center animate-fade-up opacity-0">
      <div class="relative aspect-[4/3] rounded-2xl overflow-hidden">
        <img src="https://images.pexels.com/photos/1903995/pexels-photo-1903995.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Bat research in field" class="w-full h-full object-cover">
      </div>
      <div>
        <p class="text-xs font-semibold uppercase tracking-[0.12em] text-primary mb-4">
          {{ $locale == 'id' ? 'Tentang Kami' : 'About Us' }}
        </p>
        <h2 class="font-heading text-3xl md:text-4xl font-bold tracking-[-0.02em] text-text mb-6">
          {{ $locale == 'id' ? 'Membangun Masa Depan Konservasi' : 'Building the Future of Conservation' }}
        </h2>
        <p class="text-muted mb-4 leading-relaxed">
          {{ trans_for('about.description') }}
        </p>
        <p class="text-muted mb-4 leading-relaxed">
          {{ trans_for('about.founded') }}
        </p>
        <p class="text-muted font-medium">
          {{ trans_for('about.legalId') }}
        </p>
      </div>
    </div>
  </div>
</section>

{{-- Values Section --}}
<section class="py-24 bg-surface-warm border-t border-border">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="text-center mb-16 animate-fade-up opacity-0">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-primary mb-4">
        {{ $locale == 'id' ? 'Nilai-Nilai Kami' : 'Our Values' }}
      </p>
      <h2 class="font-heading text-3xl md:text-4xl font-bold tracking-[-0.02em] text-text">
        {{ $locale == 'id' ? 'Prinsip yang Memandu Kami' : 'Principles That Guide Us' }}
      </h2>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
      <div class="bg-background rounded-2xl p-6 md:p-8 border border-border text-center group hover:border-primary/30 transition-colors cursor-pointer animate-fade-up opacity-0" style="animation-delay: 0.1s;">
        <h3 class="font-heading text-lg font-semibold text-text mb-3">
          {{ $locale == 'id' ? 'Integritas' : 'Integrity' }}
        </h3>
        <p class="text-muted text-sm leading-relaxed">
          {{ $locale == 'id' ? 'Menjunjung tinggi kejujuran dan transparansi dalam setiap kegiatan' : 'Upholding honesty and transparency in every activity' }}
        </p>
      </div>

      <div class="bg-background rounded-2xl p-6 md:p-8 border border-border text-center group hover:border-primary/30 transition-colors cursor-pointer animate-fade-up opacity-0" style="animation-delay: 0.2s;">
        <h3 class="font-heading text-lg font-semibold text-text mb-3">
          {{ $locale == 'id' ? 'Keunggulan' : 'Excellence' }}
        </h3>
        <p class="text-muted text-sm leading-relaxed">
          {{ $locale == 'id' ? 'Berdedikasi untuk hasil penelitian berkualitas tinggi' : 'Dedicated to high-quality research outcomes' }}
        </p>
      </div>

      <div class="bg-background rounded-2xl p-6 md:p-8 border border-border text-center group hover:border-primary/30 transition-colors cursor-pointer animate-fade-up opacity-0" style="animation-delay: 0.3s;">
        <h3 class="font-heading text-lg font-semibold text-text mb-3">
          {{ $locale == 'id' ? 'Kolaborasi' : 'Collaboration' }}
        </h3>
        <p class="text-muted text-sm leading-relaxed">
          {{ $locale == 'id' ? 'Membangun kemitraan yang kuat dengan berbagai pihak' : 'Building strong partnerships with various stakeholders' }}
        </p>
      </div>

      <div class="bg-background rounded-2xl p-6 md:p-8 border border-border text-center group hover:border-primary/30 transition-colors cursor-pointer animate-fade-up opacity-0" style="animation-delay: 0.4s;">
        <h3 class="font-heading text-lg font-semibold text-text mb-3">
          {{ $locale == 'id' ? 'Konservasi' : 'Conservation' }}
        </h3>
        <p class="text-muted text-sm leading-relaxed">
          {{ $locale == 'id' ? 'Berkomitmen untuk melindungi kelelawar dan habitatnya' : 'Committed to protecting bats and their habitats' }}
        </p>
      </div>
    </div>
  </div>
</section>
@endsection