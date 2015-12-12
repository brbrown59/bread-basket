<?php

require_once("prefix-utilities.php");

?>

<!--CDN derived Angular.js -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-messages.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.14.3/ui-bootstrap-tpls.min.js"></script>

<!--minified Pusher JS-->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/angular-pusher/0.0.14/angular-pusher.min.js"></script>

<!--relevant app and password min files-->
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/breadbasket.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/pusher-config.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/angular-password.min.js"></script>

<!--Angular Services-->
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/services/volunteer-service.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/services/organization-service.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/services/alert-service.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/services/listing-service.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/services/listingtype-service.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/services/message-service.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/services/sign-in-service.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/services/sign-up-service.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/services/sign-out-service.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/services/get-current-service.js"></script>

<!--Angular Controllers-->

<script type="text/javascript" src="<?php echo $PREFIX; ?>js/controllers/alert-controller.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/controllers/contact-controller.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/controllers/signup-controller.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/controllers/signin-controller.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/controllers/sign-out-controller.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/controllers/volunteer-controller.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/controllers/listing-controller.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/controllers/listingtype-controller.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/controllers/message-controller.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/controllers/organization-controller.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/controllers/validation-controller.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/controllers/tabs.js"></script>

<!--Angular Modal Controllers-->
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/modalcontrollers/signup-modal.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/modalcontrollers/signin-modal.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/modalcontrollers/newvolunteer-modal.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/modalcontrollers/newlisting-modal.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/modalcontrollers/contact-modal.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/modalcontrollers/editvolunteer-modal.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/modalcontrollers/listingdetail-modal.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/modalcontrollers/editlisting-modal.js"></script>

<!--Angular Directives-->
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/directives/org-view.js"></script>
<script type="text/javascript" src="<?php echo $PREFIX; ?>js/directives/org-edit.js"></script>