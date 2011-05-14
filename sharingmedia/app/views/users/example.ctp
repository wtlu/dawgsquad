<script src="http://static.ak.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
<script type="text/javascript">
    FB.init("xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx", "/xd_receiver.htm");
    window.addEvent('domready',function(){
        FB_RequireFeatures(["CanvasUtil"], function(){
                FB.XdComm.Server.init("/xd_receiver.htm");
        });
    });
</script>
<?php
var user_message_prompt = "Login";
var user_message = {value: "Default message"};
if (FB.Connect) {
        FB.Connect.showFeedDialog(templateBundle, templateData, null,null,null,FB.RequireConnect.require,null,user_message_prompt,user_message);
}
?>

<h1>LOGIN2</h1>