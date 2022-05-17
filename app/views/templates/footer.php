<!-- <?php 
        echo '<pre>';
        print_r($_SESSION);
        print_r($_SESSION['login']['type']);
        echo '</pre>';
    ?>  -->
            </div>
            <!-- end of content -->
            <footer class="footer">
                Copyright © 2021 Winda. <br> <strong>STMIK HORIZON KARAWANG</strong> 
            </footer>
        </div>
        
    </div>
    
</body>
   
    <!-- App js -->
    <script src="<?= BASEURL?>/assets/js/app.js"></script>
    <script>
        function reload_location(url){
        location.href = "<?= BASEURL;?>/"+url;
    }
    </script>

 
</html>