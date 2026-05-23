<footer class="bg-surface-warm border-t border-border py-16 px-6 lg:px-8">
  <div class="max-w-6xl mx-auto">
    <div class="flex items-start justify-between mb-12">
      <div class="flex flex-col items-start">
        <img src="/images/Logo/InaBCRU_LOGO CERAH HORIZONTAL.webp" alt="InaBCRU" class="h-40 w-auto" style="object-fit: contain;">
        <p class="text-gray-500 text-sm leading-relaxed">{{ trans_for('footer.tagline', $locale) }}</p>
      </div>

      <div class="text-right">
        <h4 class="font-heading font-semibold text-base mb-4">{{ trans_for('footer.contactInfo', $locale) }}</h4>
        <ul class="space-y-2.5">
          <li class="text-gray-500 text-sm">{{ trans_for('footer.email', $locale) }}: info.inabcru@gmail.com</li>
          <li class="text-gray-500 text-sm">{{ trans_for('footer.founded', $locale) }}: February 5, 2025</li>
        </ul>
      </div>
    </div>
  </div>
</footer>