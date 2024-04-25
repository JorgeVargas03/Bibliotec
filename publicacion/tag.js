<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    $(document).ready(function() {
        $('input[name="etiquetas"]').on('input', function() {
            let etiquetas = $(this).val().split('#').filter(function(el) {
                return el !== '';
            });

            etiquetas = etiquetas.slice(0, 5);
            $(this).val('#' + etiquetas.join('#').replace(/\s/g, '').replace(/#/g, ' #'));
        });

        $('input[name="etiquetas"]').on('keydown', function(event) {
            if (event.key === 'Backspace' && $(this).val() === '') {
                event.preventDefault();
                $(this).prev('.etiqueta').remove();
            }
        });
    });

