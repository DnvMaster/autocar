<footer class="border-t border-gray-200 bg-white px-6 py-4">
    <div class="flex flex-col sm:flex-row items-center justify-between gap-2">
        <p class="text-sm text-gray-500"> © {{ date('Y') }} AutoCar. {{ __('ui.footer.copyright') }}</p>
        <div class="flex items-center gap-4 text-sm text-gray-500">
            <span> {{ __('ui.footer.subtitle') }}</span>
            <span class="text-gray-300">•</span>
            <span>{{ __('ui.footer.version') }}</span>
        </div>
    </div>
</footer>
