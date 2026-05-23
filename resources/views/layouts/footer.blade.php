<footer class="bg-surface-warm border-t border-border py-16 px-6 lg:px-8">
  <div class="max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-12 gap-8">
      <div class="flex flex-col gap-1.5">
        <img
          src="/images/Logo/InaBCRU_LOGO CERAH HORIZONTAL.webp"
          alt="InaBCRU"
          style="width: 300px; height: 200px; object-fit: cover; object-position: left center; margin-bottom: -70px;"
        >
        <p class="text-gray-500 text-sm leading-relaxed">{{ trans_for('footer.tagline', $locale) }}</p>
      </div>
      <div class="text-right flex-shrink-0">
        <h4 class="font-heading font-semibold text-base mb-3">{{ trans_for('footer.contactInfo', $locale) }}</h4>
        <ul class="space-y-2.5">
          <li class="text-gray-500 text-sm">{{ trans_for('footer.email', $locale) }}: info.inabcru@gmail.com</li>
          <li class="text-gray-500 text-sm">{{ trans_for('footer.founded', $locale) }}: February 5, 2025</li>
        </ul>
      </div>
    </div>
  </div>
</footer>