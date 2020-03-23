@foreach (['danger', 'warning', 'success', 'info'] as $notification)
    @if(Session::has($notification))
        <script type="text/javascript">
            jQuery(document).ready(function() {
                swal({
                    // position: 'top-end',
                    type: '{{ $notification }}',
                    title: '{{ Session::get($notification) }}',
                    showConfirmButton: true,
                    timer: 3000
                })
            });
        </script>
    @endif
@endforeach

@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <script type="text/javascript">
            jQuery(document).ready(function() {
                toastr.error("{{ $error }}" , "Error !", {timeOut: 3000});
            });
        </script>
    @endforeach
@endif