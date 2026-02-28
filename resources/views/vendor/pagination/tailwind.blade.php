@if ($paginator->hasPages())
        <div class="hidden flex gap-2 items-center justify-between sm:hidden">

            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 cursor-not-allowed leading-5 rounded-md dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-700 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-800 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-900 dark:hover:text-gray-200">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-700 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-800 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-900 dark:hover:text-gray-200">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 cursor-not-allowed leading-5 rounded-md dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600">
                    {!! __('pagination.next') !!}
                </span>
            @endif

        </div>

        <div class=" sm:flex-1 sm:flex sm:gap-2 sm:items-center sm:justify-between">

            <div class="hidden">
                <p class="text-sm text-gray-700 leading-5 dark:text-gray-600">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>


            <div class="mt-3 sm:mt-10">
                <ul class="flex flex-row justify-center items-center gap-6">
                    @if ($paginator->onFirstPage())
                        <li class="disabled text-lg md:text-2xl font-medium" aria-disabled="true" aria-label="« Назад">
                            <span aria-hidden="true">
                              <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.71866 10.4659H3.44309L-8.88109e-05 5.35231V5.18185H2.44593L5.71866 10.4659ZM5.71866 3.29018e-05L2.44593 5.28412H-8.88109e-05V5.11367L3.44309 3.29018e-05H5.71866ZM10.4999 10.4659H8.22434L4.78116 5.35231V5.18185H7.22718L10.4999 10.4659ZM10.4999 3.29018e-05L7.22718 5.28412H4.78116V5.11367L8.22434 3.29018e-05H10.4999Z" fill="#0B2641"/>
                              </svg>
                            </span>
                        </li>
                    @else
                        <li class="text-lg md:text-2xl font-medium" aria-disabled="true" aria-label="« Назад">
                            <a href="{{ $paginator->previousPageUrl() }}" rel="next">
                                <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.71866 10.4659H3.44309L-8.88109e-05 5.35231V5.18185H2.44593L5.71866 10.4659ZM5.71866 3.29018e-05L2.44593 5.28412H-8.88109e-05V5.11367L3.44309 3.29018e-05H5.71866ZM10.4999 10.4659H8.22434L4.78116 5.35231V5.18185H7.22718L10.4999 10.4659ZM10.4999 3.29018e-05L7.22718 5.28412H4.78116V5.11367L8.22434 3.29018e-05H10.4999Z" fill="#0B2641"/>
                                </svg>
                            </a>
                        </li>
                    @endif
                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <li aria-disabled="true">
                                    <span class="text-lg md:text-2xl text-[#8F8F8F] hover:text-blue-primary font-medium">...</span>
                                </li>
                            @endif
                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <li>
                                            <span class="text-lg md:text-2xl text-blue-primary font-medium">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ $url }}" class="text-lg md:text-2xl text-[#8F8F8F] hover:text-blue-primary font-medium">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($paginator->hasMorePages())
                            <li class="next">
                                <a href="{{ $paginator->nextPageUrl() }}" rel="next">
                                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M-0.000177532 10.4659L3.27255 5.18185H5.71857V5.35231L2.27539 10.4659H-0.000177532ZM-0.000177532 3.29018e-05H2.27539L5.71857 5.11367V5.28412H3.27255L-0.000177532 3.29018e-05ZM4.80664 10.4659L8.07937 5.18185H10.5254V5.35231L7.08221 10.4659H4.80664ZM4.80664 3.29018e-05H7.08221L10.5254 5.11367V5.28412H8.07937L4.80664 3.29018e-05Z" fill="#0B2641"/>
                                    </svg>
                                </a>
                            </li>
                        @else
                            <li class="next">
                                <span rel="next">
                                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M-0.000177532 10.4659L3.27255 5.18185H5.71857V5.35231L2.27539 10.4659H-0.000177532ZM-0.000177532 3.29018e-05H2.27539L5.71857 5.11367V5.28412H3.27255L-0.000177532 3.29018e-05ZM4.80664 10.4659L8.07937 5.18185H10.5254V5.35231L7.08221 10.4659H4.80664ZM4.80664 3.29018e-05H7.08221L10.5254 5.11367V5.28412H8.07937L4.80664 3.29018e-05Z" fill="#0B2641"/>
                                    </svg>
                                </span>
                            </li>
                        @endif
                </ul>
            </div>



            <div class="hidden">
                <span class="inline-flex rtl:flex-row-reverse shadow-sm rounded-md">

                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-not-allowed rounded-l-md leading-5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:active:bg-gray-700 dark:focus:border-blue-800 dark:text-gray-300 dark:hover:bg-gray-900 dark:hover:text-gray-300" aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-gray-200 border border-gray-300 cursor-default leading-5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-700 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800 hover:bg-gray-100 dark:hover:bg-gray-900" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:active:bg-gray-700 dark:focus:border-blue-800 dark:text-gray-300 dark:hover:bg-gray-900 dark:hover:text-gray-300" aria-label="{{ __('pagination.next') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }} 22222">
                            <span class="inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-not-allowed rounded-r-md leading-5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>

@endif
