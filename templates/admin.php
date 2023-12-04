<div class="wrap">
    <h1>KMC Fitogram</h1>
    <?php settings_errors(); ?>

    <form method="post" action="options.php">
        <?php
        settings_fields('kmc_fitogram_options_group');
        do_settings_sections('kmc_fitogram');
        submit_button();
        ?>
    </form>
</div>