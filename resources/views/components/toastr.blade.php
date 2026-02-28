{{-- resources/views/components/toastr.blade.php --}}
@php
    $toastrMessages = collect(['success', 'error', 'warning', 'info'])
        ->mapWithKeys(fn($type) => [$type => session($type)])
        ->filter();
@endphp

@if($toastrMessages->isNotEmpty())
    <link rel="stylesheet" href="{{ asset('assets/libs/toastr/toastr.min.css') }}">
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>
    <script>
        // Настройки toastr
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000",
            "preventDuplicates": true,
        };

        // Показ всех сообщений
        @foreach($toastrMessages as $type => $message)
        toastr.{{ $type }}("{{ $message }}");
        @endforeach
    </script>
@endif
