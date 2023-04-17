<script>
    var notyf = new Notyf({
        position: {x: 'right', y: 'top'},
        dismissible: true
    });

    window.addEventListener('toast', event => {
        notyf.success(event.detail);
    });
</script>
