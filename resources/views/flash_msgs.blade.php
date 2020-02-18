@foreach (['danger', 'warning', 'success', 'info'] as $notification)
    @if(Session::has($notification))
    <script type="text/javascript">
        jQuery(document).ready(function() {
            // toastr.options.positionClass = 'toast-bottom-right';
            // toastr.success("{{ Session::get($notification) }}", {timeOut: 5000});

            // swal("Good job!", "You clicked the button!", "success");
            swal({
                // position: 'top-end',
                type: '{{ $notification }}',
                title: '{{ Session::get($notification) }}',
                showConfirmButton: true,
                timer: 2000
            })
        });
    </script>
    @endif
@endforeach

<!-- @if(Session::has('errorMsg'))
<script type="text/javascript">
    jQuery(document).ready(function() {
         // toastr.error("{{ Session::get('errorMsg') }}", {timeOut: 5000});
        swal({
           // position: 'top-end',
           type: 'error',
           title: '{{ Session::get("errorMsg") }}',
           showConfirmButton: true,
           timer: 2000
        })
     });
</script>
@endif -->

@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
    <script type="text/javascript">
        jQuery(document).ready(function() {
            toastr.error("{{ $error }}" , "Error !", {timeOut: 2000});
        });
    </script>
    @endforeach
@endif