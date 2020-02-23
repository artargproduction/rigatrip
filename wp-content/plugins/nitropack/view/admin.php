<div id="nitropack-container" class="wrap">
    <div id="heading">
        <h2>NitroPack.io</h2>
    </div>

    <form method="post" action="options.php" name="form">
        <?php settings_fields( NITROPACK_OPTION_GROUP ); ?>
        <?php do_settings_sections( NITROPACK_OPTION_GROUP ); ?>

        <ul class="nav nav-tabs nav-tab-wrapper">
            <li><a class="nav-tab active" href="#dashboard" data-toggle="tab">Dashboard</a></li>
            <li><a class="nav-tab" href="#help" data-toggle="tab">Help</a></li>
        </ul>		
        <div class="tab-content">
            <div id="dashboard" class="tab-pane hidden">
                <?php require_once "dashboard.php"; ?>
            </div>
            <div id="help" class="tab-pane hidden">
                <?php require_once "help.php"; ?>
            </div>
        </div>
    </form>
</div>
<div class="fb-chat" data-toggle="tooltip" title="Ask us anything on Facebook Messenger">
  <a href="https://m.me/getnitropack" target="_blank">
    <svg width="60px" height="60px" viewBox="0 0 60 60">
      <svg x="0" y="0" width="60px" height="60px">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g>
        <circle fill="#007bff" cx="30" cy="30" r="30"></circle>
        <svg x="10" y="10">
          <g transform="translate(0.000000, -10.000000)" fill="#FFFFFF">
          <g id="logo" transform="translate(0.000000, 10.000000)">
          <path fill="#fff" d="M20,0 C31.2666,0 40,8.2528 40,19.4 C40,30.5472 31.2666,38.8 20,38.8 C17.9763,38.8 16.0348,38.5327 14.2106,38.0311 C13.856,37.9335 13.4789,37.9612 13.1424,38.1098 L9.1727,39.8621 C8.1343,40.3205 6.9621,39.5819 6.9273,38.4474 L6.8184,34.8894 C6.805,34.4513 6.6078,34.0414 6.2811,33.7492 C2.3896,30.2691 0,25.2307 0,19.4 C0,8.2528 8.7334,0 20,0 Z M7.99009,25.07344 C7.42629,25.96794 8.52579,26.97594 9.36809,26.33674 L15.67879,21.54734 C16.10569,21.22334 16.69559,21.22164 17.12429,21.54314 L21.79709,25.04774 C23.19919,26.09944 25.20039,25.73014 26.13499,24.24744 L32.00999,14.92654 C32.57369,14.03204 31.47419,13.02404 30.63189,13.66324 L24.32119,18.45264 C23.89429,18.77664 23.30439,18.77834 22.87569,18.45674 L18.20299,14.95224 C16.80079,13.90064 14.79959,14.26984 13.86509,15.75264 L7.99009,25.07344 Z"></path>
          </g>
          </g>
        </svg>
        </g>
        </g>
      </svg>
    </svg>
  </a>
</div>
<script>
(function($) {
    window.Notification = (_ => {
        var timeout;

        var display = (msg, type) => {
            clearTimeout(timeout);
            $('#nitropack-notification').remove();

            $('[name="form"]').prepend('<div id="nitropack-notification" class="notice notice-' + type + '" is-dismissible"><p>' + msg + '</p></div>');

            timeout = setTimeout(_ => {
                $('#nitropack-notification').remove();
            }, 10000);
            loadDismissibleNotices();
        }

        return {
            success: msg => {
                display(msg, 'success');
            },
            error: msg => {
                display(msg, 'error');
            },
            info: msg => {
                display(msg, 'info');
            },
            warning: msg => {
                display(msg, 'warning');
            }
        }
    })();

    const clearCacheHandler = clearCacheAction => {
        return function(success, error) {
            $.ajax({
                url: ajaxurl,
                type: 'GET',
                data: {
                    action: "nitropack_" + clearCacheAction + "_cache"
                },
                dataType: 'json',
                beforeSend: function() {
                    Notification.info("Loading. Please wait...");
                },
                success: function(data) {
                    Notification[data.type](data.message);

                    cacheEvent = new Event("cache." + clearCacheAction + ".success");
                    window.dispatchEvent(cacheEvent);
                }
            });
        };
    }

    $(window).load(_ => {
        //Remove styles from jobcareer and jobhunt plugins since they break our layout. They should not be loaded on our options page anyway.
        $('link[href*="jobcareer"').remove();
        $('link[href*="jobhunt"').remove();

        $("#dashboard").addClass("fade show active");
        window.addEventListener('cache.invalidate.request', clearCacheHandler("invalidate"));
        window.addEventListener('cache.purge.request', clearCacheHandler("purge"));

        NitroPack.QuickSetup.setChangeHandler(async function(value, success, error) {
            success(value);
        });
    });
})(jQuery);
</script>
