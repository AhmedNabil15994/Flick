    {!! field()->select(
      'country_id',
    __('influencer::dashboard.influencers.form.country_id'),
       $countries->pluck('title', 'id')->toArray(),
) !!}

{!! field()->select(
    'city_id',
    __('influencer::dashboard.influencers.form.city_id'),
     [],
    null,
    [
        'disabled' => true,
        'class' => '  form-control',
    ],
) !!}

{!! field()->select(
    'state_id',
    __('influencer::dashboard.influencers.form.state_id'),
     [],
    null ,
    [
        'disabled' => true,
        'class' => '  form-control',
    ],
) !!}


@push('scripts')
    <script>
        $(document).ready(function() {
            //varaible 
            var country = $("#country_id")
            var city_id = $("#city_id")
            var state_id = $("#state_id")

            function handleCity() {
                city_id.prop("disabled", !country.val() || country.val() == 0 )
                if (!country.val() || country.val() == 0) {
                    city_id.val(null).trigger("change")
                    return
                }
                city_id.select2({
                    ajax: {
                        url: "{{ route('dashboard.cities.show.options') }}",
                        data: function(params) {
                            var query = {
                                search: params.term,
                                country_id: country.val(),
                                page: params.page || 1
                            }

                            // Query parameters will be ?search=[term]&type=public
                            return query;
                        },
                        processResults: function(data, params) {
                            params.page = params.page || 1;
                            var results = data.data ? data.data.map(function(object) {
                                return {
                                    id: object.id,
                                    text: object.title
                                }
                            }) : []
                            // Transforms the top-level key of the response object from 'items' to 'results'
                            return {
                                results: results,
                                pagination: {
                                    more: data.links.next ? true : false
                                }
                            };
                        }
                    }
                });
            }

            function handleSate() {
                state_id.prop("disabled", !city_id.val() || city_id.is(':disabled') )
                if (!city_id.val()) return
                state_id.select2({
                    ajax: {
                        url: "{{ route('dashboard.states.show.options') }}",
                        data: function(params) {
                            var query = {
                                search: params.term,
                                city_id: city_id.val(),
                                page: params.page || 1
                            }

                            // Query parameters will be ?search=[term]&type=public
                            return query;
                        },
                        processResults: function(data, params) {
                            params.page = params.page || 1;
                            var results = data.data ? data.data.map(function(object) {
                                return {
                                    id: object.id,
                                    text: object.title
                                }
                            }) : []
                            // Transforms the top-level key of the response object from 'items' to 'results'
                            return {
                                results: results,
                                pagination: {
                                    more: data.links.next ? true : false
                                }
                            };
                        }
                    }
                });
            }
            handleCity()
            handleSate()
            country.on("change", function() {
                city_id.empty()
                handleCity()
            })
            city_id.on("change", function() {
                state_id.empty();
                handleSate()
            })
        });
    </script>
@endpush


