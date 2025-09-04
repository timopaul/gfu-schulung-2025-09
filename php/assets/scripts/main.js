document.addEventListener('DOMContentLoaded', function() {

    // confirmation before action
    document.querySelectorAll('.btn-confirm').forEach(function(button) {
        button.addEventListener('click', function(event) {
            if ( ! confirm(event.target.dataset.message)) {
                event.preventDefault();
            }
        });
    });

});