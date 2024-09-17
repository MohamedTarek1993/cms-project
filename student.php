<?php
include('includes/header.php');

?>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('466cb157af6ba7eca4b8', {
    cluster: 'eu'
});

var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data) {
    toastr.success(JSON.stringify(data.message));
});
</script>


test  notfication

<!-- Footer -->
<?php include 'includes/footer.php'; ?>
<!-- /.container -->