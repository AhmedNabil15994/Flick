 <!-- Start JS FILES -->
 <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
 <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
 <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
 <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
 <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
 <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
 <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
 <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
 <script src="{{ asset('frontend/js/select2.min.js') }}"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
 <script src="{{ asset('frontend/js/script-en.js') }}"></script>
 <script src="{{ asset('frontend/js/custom-en.js') }}"></script>
 <script src="{{ asset('frontend/js/notifications.js') }}"></script>
 @stack('frontend_scripts')
 @if ($errors->any())
     @foreach ($errors->all() as $error)
         <script>
             toastr.error("{{ $error }}");
         </script>
     @endforeach

 @endif

 <script>
    function saveinfluencercampaigns(btn){
        btn = $(btn);
        let form = btn.parent().parent();
        let url = form.attr('action');
        var values = {};
        $.each(form.serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });
        console.log(values);
        $.ajax({
            url: url,
            type: "POST",
            data: values,

            beforeSend: function () {
                btn.prop("disabled", true);
            },
            success: function (data) {
                btn.prop("disabled", false);
            },
            error: function (data) {
                btn.prop("disabled", false);
            }
        });
    }
 </script>