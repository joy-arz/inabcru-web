<footer class="bg-surface-warm border-t border-border py-16 px-6 lg:px-8">
  <div class="max-w-6xl mx-auto">
    <div class="grid md:grid-cols-4 gap-12 mb-12">
      <div>
        <a href="/{{ $locale }}" class="flex items-center gap-3 mb-4">
          <img src="/images/Logo/InaBCRU_LOGO GELAP A.webp" alt="InaBCRU" class="h-14 w-auto object-contain">
          <span class="font-heading font-bold text-xl">InaBCRU</span>
        </a>
        <p class="text-gray-500 text-sm leading-relaxed">{{ trans_for('footer.tagline', $locale) }}</p>
      </div>

      <div>
        <h4 class="font-heading font-semibold text-base mb-4">{{ trans_for('footer.quickLinks', $locale) }}</h4>
        <ul class="space-y-2.5">
          <li><a href="/{{ $locale }}" class="text-gray-500 text-sm hover:text-primary transition-colors">{{ trans_for('nav.home', $locale) }}</a></li>
          <li><a href="/{{ $locale }}/about" class="text-gray-500 text-sm hover:text-primary transition-colors">{{ trans_for('nav.about', $locale) }}</a></li>
          <li><a href="/{{ $locale }}/team" class="text-gray-500 text-sm hover:text-primary transition-colors">{{ trans_for('nav.team', $locale) }}</a></li>
          <li><a href="/{{ $locale }}/publications" class="text-gray-500 text-sm hover:text-primary transition-colors">{{ trans_for('nav.publications', $locale) }}</a></li>
          <li><a href="/{{ $locale }}/donate" class="text-gray-500 text-sm hover:text-primary transition-colors">{{ trans_for('nav.donate', $locale) }}</a></li>
        </ul>
      </div>

      <div>
        <h4 class="font-heading font-semibold text-base mb-4">{{ trans_for('footer.resources', $locale) }}</h4>
        <ul class="space-y-2.5">
          <li><a href="/{{ $locale }}/programs" class="text-gray-500 text-sm hover:text-primary transition-colors">{{ trans_for('nav.programs', $locale) }}</a></li>
          <li><a href="/{{ $locale }}/news" class="text-gray-500 text-sm hover:text-primary transition-colors">{{ trans_for('nav.news', $locale) }}</a></li>
          <li><a href="/{{ $locale }}/impact" class="text-gray-500 text-sm hover:text-primary transition-colors">{{ trans_for('nav.impact', $locale) }}</a></li>
          <li><a href="/{{ $locale }}/contact" class="text-gray-500 text-sm hover:text-primary transition-colors">{{ trans_for('nav.contact', $locale) }}</a></li>
        </ul>
      </div>

      <div>
        <h4 class="font-heading font-semibold text-base mb-4">{{ trans_for('footer.contactInfo', $locale) }}</h4>
        <ul class="space-y-2.5">
          <li class="text-gray-500 text-sm">{{ trans_for('footer.email', $locale) }}: info.inabcru@gmail.com</li>
          <li class="text-gray-500 text-sm">{{ trans_for('footer.founded', $locale) }}: February 5, 2025</li>
        </ul>
      </div>
    </div>

    <div class="pt-8 border-t border-border text-center">
      <p class="text-gray-400 text-xs mb-1">&copy; {{ date('Y') }} Indonesia Bat Conservation Research Union</p>
      <p class="text-gray-400 text-xs">AHU-0009178.AH.01.07.TAHUN 2025</p>
    </div>
  </div>
</footer>