<?php ?>


<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Your Website 2014</p>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>

    <!-- /.row -->
</footer>


<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"> </script>

<script>
// Get all nav links
const navLinks = document.querySelectorAll('.nav-link, .dropdown-item, .nav > li > a');

// Function to handle adding 'active' class
function setActiveClass(event) {
    // Remove 'active' class from all links
    navLinks.forEach(link => link.classList.remove('active'));

    // Add 'active' class to the clicked link
    event.currentTarget.classList.add('active');
}

// Add click event listener to each link
navLinks.forEach(link => {
    link.addEventListener('click', setActiveClass);
});
</script>

</body>

</html>