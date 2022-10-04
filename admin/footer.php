            
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="../assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="../assets/libs/js/main-js.js"></script>
    <!-- chart chartist js -->
    <script src="../assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="../assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="../assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="../assets/vendor/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <script src="../assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="../assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="../assets/vendor/charts/c3charts/C3chartjs.js"></script>
    <script src="../assets/libs/js/dashboard-ecommerce.js"></script>

    <script>
        $(function () {
            
            var url = window.location;
            $('.nav-item').find('.active').removeClass('active');
            $('.nav-item .nav-link').each(function () {
                if (this.href == url.href) {
                    if (this.href.includes('index.php')) {
                        $(this).addClass('active');
                    }
                    $(this).parents('.nav-item').find('[data-target]').addClass('active');
                }
            }); 

            let deps = {
                CIT: '<option selected disabled value="">-choose a department-</option><option value="Computer Science">Computer Science</option><option value="Computer Engineering">Computer Engineering</option><option value="Software Engineering">Software Engineering</option><option value="Cyber Security">Cyber Security</option><option value="Network and Security Engineering">Network and Security Engineering</option><option value="Computer Information Systems">Computer Information Systems</option>',
                Language: ' <option selected disabled value="">-choose a department-</option><option value="Language Center">Language Center</option>',
                Nursing: '<option selected disabled value="">-choose a department-</option><option value="Nursing">Nursing</option> <option value="Midwifery">Midwifery</option>',
            };
            $('#faculty').change(function () {
                var fac_name = $(this).val();
                $("#department").html(deps[fac_name]);
            });

        });// ready
    </script>
</body>
 
</html>