</body>

<script>
    $(document).ready(function () {

        $("#titel").keypress(function (e) {
            var titelInput = this.value;
            $("h3 b span").html(titelInput);
        });

        function close_accordion_section() {
            $('.accordion .accordion-section-title').removeClass('active');
            $('.accordion .accordion-section-content').slideUp(300).removeClass('open');
        }

        $('.accordion-section-title').click(function (e) {

            var currentAttrValue = $(this).attr('href');
            if ($(e.target).is('.active')) {
                close_accordion_section();
            } else {
                close_accordion_section();
                $(this).addClass('active');
                $('.accordion ' + currentAttrValue).slideDown(300).addClass('open');
            }
            e.preventDefault();
        });
    });
</script>
</html>