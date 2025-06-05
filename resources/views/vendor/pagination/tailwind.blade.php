@if ($paginator->hasPages())
<div class="flex items-center justify-between bg-white px-4 pt-4">
  <div class="flex flex-1 justify-between sm:hidden">
    {{-- Previous --}}
    @if ($paginator->onFirstPage())
      <span class="relative inline-flex items-center rounded-md bg-white px-4 py-2 text-xs font-medium text-gray-400 cursor-default">Previous</span>
    @else
      <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center rounded-md bg-white px-4 py-2 text-xs font-medium hover:bg-gray-50">Previous</a>
    @endif

    {{-- Next --}}
    @if ($paginator->hasMorePages())
      <a href="{{ $paginator->nextPageUrl() }}" class="relative ml-3 inline-flex items-center rounded-md bg-white px-4 py-2 text-xs font-medium hover:bg-gray-50">Next</a>
    @else
      <span class="relative ml-3 inline-flex items-center rounded-md bg-white px-4 py-2 text-xs font-medium text-gray-400 cursor-default">Next</span>
    @endif
  </div>

  <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
    <div>
      <p class="text-xs text-gray-400">
        Menampilkan
        @if ($paginator->firstItem())
          <span>{{ $paginator->firstItem() }}</span>
          sampai
          <span>{{ $paginator->lastItem() }}</span>
        @else
          {{ $paginator->count() }}
        @endif
        dari
        <span>{{ $paginator->total() }}</span>
        hasil
      </p>
    </div>
    <div>
      <nav class="isolate inline-flex -space-x-px rounded-md" aria-label="Pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
          <span aria-disabled="true" aria-label="@lang('pagination.previous')" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 cursor-default">
            <span class="sr-only">@lang('pagination.previous')</span>
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
            </svg>
          </span>
        @else
          <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 hover:bg-gray-50 focus:z-20 focus:outline-offset-0" aria-label="@lang('pagination.previous')">
            <span class="sr-only">@lang('pagination.previous')</span>
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
            </svg>
          </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
          {{-- "Three Dots" Separator --}}
          @if (is_string($element))
            <span aria-disabled="true" class="relative inline-flex items-center w-8 h-8 text-xs font-normal cursor-default">
              {{ $element }}
            </span>
          @endif

          {{-- Array Of Links --}}
          @if (is_array($element))
            @foreach ($element as $page => $url)
              @if ($page == $paginator->currentPage())
                <span aria-current="page" class="m-1 relative z-10 inline-flex items-center justify-center rounded-full bg-primary/10 w-8 h-8 text-xs font-semibold text-primary focus:z-20 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                  {{ $page }}
                </span>
              @else
                <a href="{{ $url }}" class="m-1 relative inline-flex items-center justify-center w-8 h-8 text-xs font-normal text-gray-900 hover:bg-gray-50 focus:z-20 focus:outline-offset-0" aria-label="@lang('pagination.goto', ['page' => $page])">
                  {{ $page }}
                </a>
              @endif
            @endforeach
          @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
          <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 hover:bg-gray-50 focus:z-20 focus:outline-offset-0" aria-label="@lang('pagination.next')">
            <span class="sr-only">@lang('pagination.next')</span>
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
          </a>
        @else
          <span aria-disabled="true" aria-label="@lang('pagination.next')" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 cursor-default">
            <span class="sr-only">@lang('pagination.next')</span>
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
          </span>
        @endif
      </nav>
    </div>
  </div>
</div>
@endif
