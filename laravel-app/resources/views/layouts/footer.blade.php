<footer class="bg-surface-warm border-t border-border py-16 px-6 lg:px-8">
  <div class="max-w-6xl mx-auto">
    <div class="grid md:grid-cols-4 gap-12 mb-12">
      <div>
        <a href="/{{ $locale }}" class="flex items-center gap-3 mb-4">
          <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-primary">
            <span class="font-heading font-bold text-xl text-white">I</span>
          </div>
          <span class="font-heading font-bold text-xl">InaBCRU</span>
        </a>
        <p class="text-muted text-sm leading-relaxed">{{ trans_for('footer.tagline', $locale) }}</p>
      </div>

      <div>
        <h4 class="font-heading font-semibold text-base mb-4">{{ trans_for('footer.quickLinks', $locale) }}</h4>
        <ul class="space-y-2.5">
          <li><a href="/{{ $locale }}" class="text-muted text-sm hover:text-primary transition-colors">{{ trans_for('nav.home', $locale) }}</a></li>
          <li><a href="/{{ $locale }}/about" class="text-muted text-sm hover:text-primary transition-colors">{{ trans_for('nav.about', $locale) }}</a></li>
          <li><a href="/{{ $locale }}/team" class="text-muted text-sm hover:text-primary transition-colors">{{ trans_for('nav.team', $locale) }}</a></li>
          <li><a href="/{{ $locale }}/publications" class="text-muted text-sm hover:text-primary transition-colors">{{ trans_for('nav.publications', $locale) }}</a></li>
          <li><a href="/{{ $locale }}/donate" class="text-muted text-sm hover:text-primary transition-colors">{{ trans_for('nav.donate', $locale) }}</a></li>
        </ul>
      </div>

      <div>
        <h4 class="font-heading font-semibold text-base mb-4">{{ trans_for('footer.quickLinks', $locale) }}</h4>
        <ul class="space-y-2.5">
          <li><a href="/{{ $locale }}/programs" class="text-muted text-sm hover:text-primary transition-colors">{{ trans_for('nav.programs', $locale) }}</a></li>
          <li><a href="/{{ $locale }}/news" class="text-muted text-sm hover:text-primary transition-colors">{{ trans_for('nav.news', $locale) }}</a></li>
          <li><a href="/{{ $locale }}/impact" class="text-muted text-sm hover:text-primary transition-colors">{{ trans_for('nav.impact', $locale) }}</a></li>
          <li><a href="/{{ $locale }}/contact" class="text-muted text-sm hover:text-primary transition-colors">{{ trans_for('nav.contact', $locale) }}</a></li>
        </ul>
      </div>

      <div>
        <h4 class="font-heading font-semibold text-base mb-4">{{ trans_for('footer.contactInfo', $locale) }}</h4>
        <ul class="space-y-2.5">
          <li class="text-muted text-sm">{{ trans_for('footer.email', $locale) }}: info.inabcru@gmail.com</li>
          <li class="text-muted text-sm">{{ trans_for('footer.founded', $locale) }}: February 5, 2025</li>
        </ul>
      </div>
    </div>

    <div class="pt-8 border-t border-border text-center">
      <p class="text-muted text-xs mb-1">&copy; {{ date('Y') }} Indonesia Bat Conservation Research Union</p>
      <p class="text-muted text-xs">AHU-0009178.AH.01.07.TAHUN 2025</p>
    </div>
  </div>
</footer>