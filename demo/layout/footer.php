<footer class='col-sm-12'>
        <center>
            <h6>SDK Version: 1.10</h6>
            <h6> &copy; 2016 LiveEnsure Inc.</h6>
        </center>
    </footer>
    </div>
    <?php
    /*Fetching Agent Id form settings.ini*/
    $agentData = parse_ini_file("../config/settings.ini", true);
    $agentId = $agentData['AGENT_ID'];
    ?>
    <script>
        var agentId = "<?php echo $agentId;?>";
        var urls = {
            host: "172.29.19.122",
            initSession: "/liveensure/sdk/apiclass.php?submit=init-session",
            addPromptChallenge: "/liveensure/sdk/apiclass.php?submit=add-prompt-challenge",
            addTimeChallenge: "/liveensure/sdk/apiclass.php?submit=add-time-challenge",
            addBehaviourChallenge: "/liveensure/sdk/apiclass.php?submit=add-behaviour-challenge",
            addBehaviourV6Challenge: "/liveensure/sdk/apiclass.php?submit=add-behaviour-v6-challenge",
            addLocationChallenge: "/liveensure/sdk/apiclass.php?submit=add-location-challenge",
            addBioChallenge: "/liveensure/sdk/apiclass.php?submit=add-bio-challenge",
            getCode: "/liveensure/sdk/apiclass.php?submit=get-code",
            pollStatus: "/liveensure/sdk/apiclass.php?submit=poll-status",
        };

        function getCookie(name) {
            var cookieValue = null;
            if (document.cookie && document.cookie !== '') {
                var cookies = document.cookie.split(';');
                for (var i = 0; i < cookies.length; i++) {
                    var cookie = jQuery.trim(cookies[i]);
                    // Does this cookie string begin with the name we want?
                    if (cookie.substring(0, name.length + 1) === (name + '=')) {
                        cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                        break;
                    }
                }
            }
            return cookieValue;
        }
        var csrftoken = getCookie('csrftoken');
        function csrfSafeMethod(method) {
            // these HTTP methods do not require CSRF protection
            return (/^(GET|HEAD|OPTIONS|TRACE)$/.test(method));
        }
        $.ajaxSetup({
            beforeSend: function(xhr, settings) {
                if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                    xhr.setRequestHeader("X-CSRFToken", csrftoken);
                }
            }
        });
    </script>
</body>
</html>