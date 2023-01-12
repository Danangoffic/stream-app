<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('user/assets/script/script.js') }}"></script>

<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script>
    $(document).ready(function() {
        $('.watched-movies').removeClass('hidden').flickity({
            // options
            "cellAlign": "left",
            "contain": true,
            "groupCells": 1,
            "wrapAround": false,
            "pageDots": false,
            "prevNextButtons": false,
            "draggable": ">1",
            "freeScroll": true,
            "lazyLoad": true,
            "bgLazyLoad": true
        });
    })
</script>
