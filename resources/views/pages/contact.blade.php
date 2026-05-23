@extends('layouts.public')

@section('title', trans_for('nav.contact', $locale) . ' | InaBCRU')
@section('description', trans_for('contact.subtitle', $locale))

@section('content')
{{-- Hero Section --}}
<section class="relative min-h-[50svh] flex items-center justify-start overflow-hidden">
  <div class="absolute inset-0">
    <img src="{{ $siteImages['hero_contact']->image_url ?? '/images/Field activity/IMG_2212.webp' }}" alt="{{ $siteImages['hero_contact']->alt_text ?? 'Contact us' }}" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-dark/70"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-dark/60 via-transparent to-transparent"></div>
  </div>
  <div class="relative z-10 max-w-6xl mx-auto px-6 lg:px-8">
    <div class="animate-fade-up opacity-0">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-white/60 mb-4">
        
      </p>
      <h1 class="font-heading text-4xl md:text-5xl font-bold tracking-[-0.02em] mb-4 text-white">
        {{ trans_for('contact.title', $locale) }}
      </h1>
      <p class="text-white/70 text-lg max-w-2xl">
        {{ trans_for('contact.subtitle', $locale) }}
      </p>
    </div>
  </div>
</section>

{{-- Contact Section --}}
<section class="py-24 bg-background">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="grid lg:grid-cols-2 gap-12 lg:gap-16">
      <div class="animate-fade-up opacity-0">
        <h2 class="font-heading text-2xl md:text-3xl font-bold text-text mb-8">
          {{ trans_for('contact.sendMessage', $locale) }}
        </h2>

        <form class="space-y-6">
          <div>
            <label class="block text-sm font-medium text-text mb-2">
              {{ trans_for('contact.name', $locale) }}
            </label>
            <input
              type="text"
              class="w-full px-4 py-3 border border-border rounded-xl text-base focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors bg-background"
              placeholder="{{ $locale == 'id' ? 'Nama lengkap' : 'Full name' }}"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-text mb-2">
              Email
            </label>
            <input
              type="email"
              class="w-full px-4 py-3 border border-border rounded-xl text-base focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors bg-background"
              placeholder="email@example.com"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-text mb-2">
              {{ $locale == 'id' ? 'Subjek' : 'Subject' }}
            </label>
            <input
              type="text"
              class="w-full px-4 py-3 border border-border rounded-xl text-base focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors bg-background"
              placeholder="{{ $locale == 'id' ? 'Subjek pesan' : 'Message subject' }}"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-text mb-2">
              {{ trans_for('contact.message', $locale) }}
            </label>
            <textarea
              rows="5"
              class="w-full px-4 py-3 border border-border rounded-xl text-base resize-none focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors bg-background"
              placeholder="{{ $locale == 'id' ? 'Tulis pesan Anda di sini...' : 'Write your message here...' }}"
            ></textarea>
          </div>

          <button type="button" class="w-full px-6 py-3 bg-primary text-white font-semibold rounded-xl hover:bg-primary/90 transition-colors duration-200 cursor-pointer">
            {{ trans_for('contact.send', $locale) }}
          </button>
        </form>
      </div>

      <div class="animate-fade-up opacity-0" style="animation-delay: 0.2s;">
        <h2 class="font-heading text-2xl md:text-3xl font-bold text-text mb-8">
          {{ trans_for('footer.contactInfo', $locale) }}
        </h2>

        <div class="space-y-4">
          <div class="flex gap-4 bg-surface-warm rounded-2xl p-6 border border-border">
            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
            </div>
            <div>
              <h3 class="font-semibold text-text mb-1">{{ trans_for('footer.email', $locale) }}</h3>
              <a href="mailto:info.inabcru@gmail.com" class="text-primary hover:underline">info.inabcru@gmail.com</a>
            </div>
          </div>

          <div class="flex gap-4 bg-surface-warm rounded-2xl p-6 border border-border">
            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </div>
            <div>
              <h3 class="font-semibold text-text mb-1">{{ trans_for('contact.location', $locale) }}</h3>
              <p class="text-muted">Yogyakarta, Indonesia</p>
            </div>
          </div>

          <div class="flex gap-4 bg-surface-warm rounded-2xl p-6 border border-border">
            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <div>
              <h3 class="font-semibold text-text mb-1">
                {{ $locale == 'id' ? 'Jam Operasional' : 'Office Hours' }}
              </h3>
              <p class="text-muted">
                {{ $locale == 'id' ? 'Senin - Jumat: 09:00 - 17:00 WIB' : 'Monday - Friday: 09:00 - 17:00 WIB' }}
              </p>
            </div>
          </div>
        </div>

        <div class="mt-8">
          <h3 class="font-heading font-semibold text-text mb-4">
            {{ $locale == 'id' ? 'Ikuti Kami' : 'Follow Us' }}
          </h3>
          <div class="flex gap-3">
            <a href="#" class="w-11 h-11 rounded-xl bg-surface-warm flex items-center justify-center text-primary border border-border hover:border-primary/30 hover:bg-primary/5 transition-all cursor-pointer">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
              </svg>
            </a>
            <a href="#" class="w-11 h-11 rounded-xl bg-surface-warm flex items-center justify-center text-primary border border-border hover:border-primary/30 hover:bg-primary/5 transition-all cursor-pointer">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
              </svg>
            </a>
            <a href="#" class="w-11 h-11 rounded-xl bg-surface-warm flex items-center justify-center text-primary border border-border hover:border-primary/30 hover:bg-primary/5 transition-all cursor-pointer">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection