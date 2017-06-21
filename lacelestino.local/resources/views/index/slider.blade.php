<div id="slider-flexslider-classic" class="slider slider-flexslider-classic flexslider container">
    <ul class="slides" style="width:100%;">
        @foreach($slider as $item)
            <li>
                <img width="1170" height="378" src="{{ asset('images/slider/' . $item->img) }}" class="attachment-full" alt="Bite2" />
            </li>
        @endforeach
    </ul>
</div>


<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('#slider-flexslider-classic.flexslider').flexslider({
            animation: 'fade',
            slideshowSpeed: 3000,
            animationSpeed: 800,
            touch: false
        });
    });
</script>