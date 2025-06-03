<form method="GET" action="">
    <button 
        name="filter" 
        value="{{ $value }}" 
        type="submit"
        class="cursor-pointer flex items-center gap-2 px-4 h-full rounded-full shadow text-xs
            {{ $active == $value ? 'bg-primary text-white' : 'bg-white hover:bg-slate-100' }}">
        @if($icon){!! $icon !!}@endif
        @if($label)<span>{!! $label !!}</span>@endif
    </button>
</form>