@extends('layouts.public')

@section('title', trans_for('donate.title') . ' | InaBCRU')
@section('description', trans_for('donate.description'))

@section('content')
{{-- Hero Section --}}
<section class="relative min-h-[50svh] flex items-center justify-center overflow-hidden">
  <div class="absolute inset-0">
    <img src="{{ $siteImages['hero_donate']->image_url ?? '/images/Field activity/IMG_2209.webp' }}" alt="{{ $siteImages['hero_donate']->alt_text ?? 'Conservation effort' }}" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-dark/70"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-dark/60 via-transparent to-transparent"></div>
  </div>
  <div class="relative z-10 max-w-6xl mx-auto px-6 lg:px-8 text-center">
    <div class="animate-fade-up opacity-0">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-white/60 mb-4">
        {{ $locale == 'id' ? 'Dukung Kami' : 'Support Us' }}
      </p>
      <h1 class="font-heading text-4xl md:text-5xl font-bold tracking-[-0.02em] mb-4 text-white">
        {{ trans_for('donate.title') }}
      </h1>
      <p class="text-white/70 text-lg max-w-2xl mx-auto">
        {{ trans_for('donate.description') }}
      </p>
    </div>
  </div>
</section>

{{-- Donate Content Section --}}
<section class="py-20 bg-background">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="grid lg:grid-cols-2 gap-12 lg:gap-16">
      <div class="animate-fade-up opacity-0">
        <h2 class="font-heading text-2xl md:text-3xl font-bold text-text mb-8">
          {{ trans_for('donate.bankTransfer') }}
        </h2>

        <div class="bg-surface-warm rounded-2xl p-6 md:p-8 border border-border mb-6">
          <div class="space-y-4">
            <div class="flex justify-between py-3.5 border-b border-border">
              <span class="text-muted">{{ trans_for('donate.bankName') }}</span>
              <span class="font-semibold text-text">Bank Central Asia (BCA)</span>
            </div>
            <div class="flex justify-between py-3.5 border-b border-border">
              <span class="text-muted">{{ trans_for('donate.accountNumber') }}</span>
              <span class="font-mono font-semibold text-text">1234567890</span>
            </div>
            <div class="flex justify-between py-3.5">
              <span class="text-muted">{{ trans_for('donate.accountName') }}</span>
              <span class="font-semibold text-text">InaBCRU</span>
            </div>
          </div>
        </div>

        <div class="bg-cta/5 rounded-2xl p-6 border border-cta/20">
          <h3 class="font-heading font-semibold text-cta mb-3">
            {{ $locale == 'id' ? 'Penting' : 'Important' }}
          </h3>
          <p class="text-muted text-sm leading-relaxed">
            {{ $locale == 'id'
              ? 'Setelah melakukan transfer, silakan kirim bukti transfer ke email kami di info.inabcru@gmail.com dengan subject "Donasi [Nama]" untuk pencatatan donasi.'
              : 'After making a transfer, please send proof of transfer to our email at info.inabcru@gmail.com with subject "Donation [Name]" for donation recording.'
            }}
          </p>
        </div>
      </div>

      <div class="animate-fade-up opacity-0" style="animation-delay: 0.2s;">
        <h2 class="font-heading text-2xl md:text-3xl font-bold text-text mb-8">
          {{ trans_for('donate.donationTiers.title') }}
        </h2>

        <div class="space-y-4">
          @php
          $tiers = [
            ['id' => 'Rp100K', 'amount' => trans_for('donate.donationTiers.Rp100K.amount'), 'impact' => trans_for('donate.donationTiers.Rp100K.impact'), 'popular' => false],
            ['id' => 'Rp500K', 'amount' => trans_for('donate.donationTiers.Rp500K.amount'), 'impact' => trans_for('donate.donationTiers.Rp500K.impact'), 'popular' => true],
            ['id' => 'Rp1M', 'amount' => trans_for('donate.donationTiers.Rp1M.amount'), 'impact' => trans_for('donate.donationTiers.Rp1M.impact'), 'popular' => false],
            ['id' => 'Rp5M', 'amount' => trans_for('donate.donationTiers.Rp5M.amount'), 'impact' => trans_for('donate.donationTiers.Rp5M.impact'), 'popular' => false],
          ];
          @endphp

          @foreach($tiers as $tier)
            <div class="bg-background rounded-2xl p-6 border {{ $tier['popular'] ? 'border-cta ring-2 ring-cta/20' : 'border-border' }} relative">
              @if($tier['popular'])
                <span class="absolute -top-3 left-6 bg-cta text-white text-xs font-semibold px-3 py-1 rounded-full">
                  {{ $locale == 'id' ? 'Populer' : 'Popular' }}
                </span>
              @endif
              <div class="flex items-center justify-between mb-3">
                <span class="font-heading text-xl font-bold text-primary">
                  {{ $tier['amount'] }}
                </span>
              </div>
              <p class="text-muted mb-4">
                {{ $tier['impact'] }}
              </p>
              <button onclick="copyAccount()" class="w-full px-5 py-2.5 {{ $tier['popular'] ? 'bg-cta text-white hover:bg-cta/90' : 'bg-surface-warm text-text hover:bg-border' }} font-medium rounded-xl transition-colors duration-200 flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
                {{ $locale == 'id' ? 'Donasi Sekarang' : 'Donate Now' }}
              </button>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Institutional Donors Section --}}
<section class="py-20 bg-surface-warm border-t border-border">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="bg-background rounded-2xl p-8 md:p-12 text-center border border-border animate-fade-up opacity-0">
      <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-primary/10 flex items-center justify-center">
        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
      </div>
      <h2 class="font-heading text-2xl font-bold text-text mb-4">
        {{ trans_for('donate.institutional.title') }}
      </h2>
      <p class="text-muted mb-6 max-w-xl mx-auto leading-relaxed">
        {{ trans_for('donate.institutional.mouInfo') }}
      </p>
      <a href="mailto:info.inabcru@gmail.com?subject=MoU%20Inquiry" class="text-primary hover:underline font-medium">
        {{ trans_for('donate.institutional.contactForMoU') }}
      </a>
    </div>
  </div>
</section>

{{-- CTA Section --}}
<section class="py-20 bg-primary text-white">
  <div class="max-w-6xl mx-auto px-6 lg:px-8 text-center">
    <div class="animate-fade-up opacity-0">
      <blockquote class="font-heading text-2xl md:text-3xl font-bold mb-8">
        "{{ trans_for('donate.ctaQuote') }}"
      </blockquote>
      <button onclick="copyAccount()" class="px-8 py-4 bg-cta text-white font-semibold rounded-xl hover:bg-cta/90 transition-all duration-200 cursor-pointer flex items-center gap-2 mx-auto">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
        </svg>
        {{ $locale == 'id' ? 'Donasi Sekarang' : 'Donate Now' }}
      </button>
    </div>
  </div>
</section>

{{-- Toast Notification --}}
<div id="toast" class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 bg-text text-white px-6 py-3 rounded-xl shadow-lg flex items-center gap-3 hidden">
  <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M5 13l4 4L19 7" />
  </svg>
  <span>{{ $locale == 'id' ? 'Nomor rekening berhasil disalin!' : 'Bank account copied!' }}</span>
</div>
@endsection

@push('scripts')
<script>
let toastTimeout;
function copyAccount() {
  const accountNumber = '1234567890';
  if (navigator.clipboard && navigator.clipboard.writeText) {
    navigator.clipboard.writeText(accountNumber).then(() => {
      showToast();
    }).catch(() => {
      fallbackCopy(accountNumber);
    });
  } else {
    fallbackCopy(accountNumber);
  }
}

function fallbackCopy(text) {
  const textarea = document.createElement('textarea');
  textarea.value = text;
  textarea.style.position = 'fixed';
  textarea.style.opacity = '0';
  document.body.appendChild(textarea);
  textarea.select();
  try {
    document.execCommand('copy');
    showToast();
  } catch (err) {
    alert('{{ $locale == "id" ? "Gagal menyalin nomor rekening" : "Failed to copy bank account" }}');
  }
  document.body.removeChild(textarea);
}

function showToast() {
  const toast = document.getElementById('toast');
  toast.style.display = 'flex';
  clearTimeout(toastTimeout);
  toastTimeout = setTimeout(() => {
    toast.style.display = 'none';
  }, 3000);
}
</script>
@endpush