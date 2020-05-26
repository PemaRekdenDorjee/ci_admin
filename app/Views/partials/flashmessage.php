
<script>
    <?php if (session()->get('success')): ?>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
         toastr.success("<?= session()->get('success')?> ");
    <?php elseif(session()->get('error')):?>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
        toastr.error("<?= session()->get('error')?> ");
    <?php elseif(session()->get('warning')):?>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
        toastr.warning("<?= session()->get('warning')?> ");
    <?php elseif(session()->get('info')):?>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
        toastr.info("<?= session()->get('info')?> ");

    <?php endif; ?>
</script>
