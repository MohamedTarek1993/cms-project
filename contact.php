<?php 

include('includes/header.php') ;
 

 if( $_SERVER['REQUEST_METHOD'] == "POST" &&  isset($_POST['submit'])) {
    global  $connection ;
    $to = $_POST['email'];
    $subject = $_POST['subject'];
    $body = $_POST['mesaage'];
 
}
 ?>

<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Contact Us</h1>
                        <form role="form" method="post" id="contact-form" autocomplete="off">

                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="Subject" class="sr-only">Subject</label>
                                <input type="text" name="subject" id="Subject" class="form-control"
                                    placeholder="Subject">
                            </div>

                            <div class="form-group">
                                <label for="Mesaage" class="sr-only">Mesaage</label>
                                <textarea class="form-control" name="mesaage" id="Mesaage"></textarea>
                            </div>


                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block"
                                value="Submit">
                        </form>
                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>





    <!-- Footer -->
    <?php   include 'includes/footer.php'; ?>
</div>
<!-- /.container -->