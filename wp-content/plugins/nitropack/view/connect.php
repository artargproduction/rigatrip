<div id="nitropack-container" class="wrap">
    <div class="row">
        <div class="col-md-12">
            <div id="login-container">
                <h3>Welcome to NitroPack for WordPress!</h3>
                <p>This page will help you to connect your WordPress site with NitroPack in few steps.</p>
                <img src="<?= plugin_dir_url(__FILE__) ?>/images/nitropackwp.jpg" alt="NitroPack"/>
                <hr />
                <h3>Let's Get Started!</h3>
                <p>In order to connect NitroPack with WordPress you need to configure your API details. More information how to obtain these values can be found <a href="https://nitropack.io/blog/post/how-to-get-your-site-id-and-site-secret" target="_blank">here <i class="fa fa-external-link"></i></a></p>
                <form class="form-default" action="options.php" method="post" id="api-details-form">
                    <?php settings_fields( NITROPACK_OPTION_GROUP );
                    do_settings_sections( NITROPACK_OPTION_GROUP ); ?>
                    <div id="submitdiv" class="postbox ">
                        <h3>Welcome</h3>
                        <h2>Enter site ID and site secret to start using NitroPack</h2>
                        <input id="nitropack-siteid-input" name="nitropack-siteId" type="text" class="form-control" placeholder="Site ID">
                        <input id="nitropack-sitesecret-input" name="nitropack-siteSecret" type="text" class="form-control" placeholder="Site Secret">
                        <div class="e-submit">
                            <a class="btn btn-primary white" id="api-details-form-submit" href="javascript:void(0);">
                                <i id="connect-spinner" class="fa fa-spinner fa-spin white" style="display:none;"></i>
                                <span id="connect-text">Connect to NitroPack</span>
                            </a>
                            <h1 id="connect-success" style="display:none;margin-bottom:auto;font-size:36px;"><i class="fa fa-check-circle"></i></h1>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
                <p>Email at <a href="mailto:sales@nitropack.io?subject=Questions on NitroPack for WordPress">sales@nitropack.io</a>, if you have any problems, questions or you just want to thank us for the good service.</p>
            </div>
        </div>
    </div>
</div>

<script>
(function($) {

    $("#api-details-form-submit").on("click", function(e) {
        e.preventDefault();
        $("#connect-spinner").show();
        $("#connect-text").hide();
        jQuery.post(ajaxurl, {
            action: 'nitropack_verify_connect',
            siteId: $("#nitropack-siteid-input").val(),
            siteSecret: $("#nitropack-sitesecret-input").val()
        }, function(response) {
            $("#connect-spinner").hide();

            var resp = JSON.parse(response);
            if (resp.status == "success") {
                $("#connect-success").show();
                $("#api-details-form-submit").hide();
                $("#api-details-form").ajaxSubmit({
                    complete: function() {
                        location.reload();
                    }
                });
                return;
            } else {
                if (resp.message) {
                    jQuery('#submitdiv').prepend('<div class="notice notice-error is-dismissible"><p>Error! ' + resp.message + '</p></div>');
                } else {
                    jQuery('#submitdiv').prepend('<div class="notice notice-error is-dismissible"><p>Error! Api details verification failed! Please check whether you entered correct details.</p></div>');
                }
                loadDismissibleNotices();
            }
            $("#connect-text").show();
        });
    });
})(jQuery);
</script>

