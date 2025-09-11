@if ($paginator->hasPages())
    <nav aria-label="Pagination" class="w-full">
        {{-- Mobile : Previous / Next saja --}}
        <div class="flex justify-between items-center sm:hidden">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600
                                 text-gray-400 dark:text-gray-500
                                 bg-white dark:bg-gray-800
                                 cursor-not-allowed">
                    <i class="fas fa-chevron-left mr-2"></i>Sebelumnya
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600
                              text-gray-700 dark:text-gray-300
                              bg-white dark:bg-gray-800
                              hover:bg-gray-50 dark:hover:bg-gray-700">
                    <i class="fas fa-chevron-left mr-2"></i>Sebelumnya
                </a>
            @endif

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600
                              text-gray-700 dark:text-gray-300
                              bg-white dark:bg-gray-800
                              hover:bg-gray-50 dark:hover:bg-gray-700">
                    Selanjutnya<i class="fas fa-chevron-right ml-2"></i>
                </a>
            @else
                <span class="px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600
                                 text-gray-400 dark:text-gray-500
                                 bg-white dark:bg-gray-800
                                 cursor-not-allowed">
                    Selanjutnya<i class="fas fa-chevron-right ml-2"></i>
                </span>
            @endif
        </div>

        {{-- Desktop : lengkap dengan angka --}}
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            {{-- Info jumlah baris --}}
            <div>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    Menampilkan
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    sampai
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    dari
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    hasil
                </p>
            </div>

            {{-- Tombol angka --}}
            <div>
                <span class="relative z-0 inline-flex rounded-lg shadow-sm">
                    {{-- Previous --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" class="px-2 py-2 rounded-l-lg border border-gray-300 dark:border-gray-600
                                         text-gray-400 dark:text-gray-500
                                         bg-white dark:bg-gray-800
                                         cursor-not-allowed">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-2 py-2 rounded-l-lg border border-gray-300 dark:border-gray-600
                                      text-gray-700 dark:text-gray-300
                                      bg-white dark:bg-gray-800
                                      hover:bg-gray-50 dark:hover:bg-gray-700">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    {{-- Halaman --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" --}}
                        @if (is_string($element))
                            <span class="px-3 py-2 border border-gray-300 dark:border-gray-600
                                                 text-gray-700 dark:text-gray-300
                                                 bg-white dark:bg-gray-800
                                                 cursor-default">
                                {{ $element }}
                            </span>
                        @endif

                        {{-- Array of links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page" class="px-3 py-2 border border-primary-600
                                                                 text-white bg-primary-600
                                                                 cursor-default">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="px-3 py-2 border border-gray-300 dark:border-gray-600
                                                              text-gray-700 dark:text-gray-300
                                                              bg-white dark:bg-gray-800
                                                              hover:bg-gray-50 dark:hover:bg-gray-700">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                            class="px-2 py-2 rounded-r-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span aria-disabled="true"
                            class="px-2 py-2 rounded-r-lg border border-gray-300 dark:border-gray-600 text-gray-400 dark:text-gray-500 bg-white dark:bg-gray-800 cursor-not-allowed">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif