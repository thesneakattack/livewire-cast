@push('css')
    <link id="bootstrap-css" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
<div class="grid grid-cols-1 gap-4 sm:grid sm:grid-cols-2">
    <div id="select2Parent" wire:ignore>
        <select class="form-control" id="select2" name="selected_sub_categories[]" multiple="multiple">
            <option value="">Select Option</option>
            @foreach ($webseries as $item)
                <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
        </select>
    </div>

    <div>
        You have selected: <strong>{{ count($selected_sub_categories) }}</strong>
    </div>
</div>
@push('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            dropdownParent: $('#select2Parent')
            $('#select2').select2();
            $('#select2').on('change', function(e) {
                var data = $('#select2').select2("val");
                @this.set('selected_sub_categories', data);
            });
        });
    </script>
@endpush
