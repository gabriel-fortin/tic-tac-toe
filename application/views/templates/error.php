

<div class="container-fluid" style="max-width: 1000px">
    <?php foreach ($error_messages as $error_item): ?>
        <div class="row">
            <div class="col-xs-12 col-sm-offset-1 col-sm-10">
                <div class="bg-warning error-message">
                    <?php echo $error_item ?>
                </div>
            </div>

        </div>
    <?php endforeach; ?>
</div>
