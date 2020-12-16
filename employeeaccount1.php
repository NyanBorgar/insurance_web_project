<?php include("header.php");
if(!isset($_SESSION[employee_id]))
{
	echo "<script>window.location.assign('employeelogin.php');</script>";
}
?>

<div id="tooplate_main">
    
    <div id="tooplate_content">
    
        <h2>About Us</h2>
                   
        <div class="image_wrapper fr_img"><img src="images/tooplate_image_01.jpg" alt="Image 01" /></div>
		<p><em>Curabitur quis augue eget mauris vulputate aliquet eu vel est. Vivamus risus massa, congue ac varius sit amet, tincidunt ut diam. Validate <a href="http://validator.w3.org/check?uri=referer" rel="nofollow"><strong>XHTML</strong></a> and <a href="http://jigsaw.w3.org/css-validator/check/referer" rel="nofollow"><strong>CSS</strong></a>.</em></p>
        
        <p>Praesent nisi mauris, iaculis ut bibendum in, vehicula et diam. Proin pulvinar nulla in justo sollicitudin tincidunt. Aliquam tristique, lectus nec condimentum egestas, neque erat posuere purus, sed interdum elit est ut sem. Sed risus quam, <a href="#">facilisis</a> vitae suscipit quis, mattis id nibh. Maecenas dignissim, nisl eget consectetur scelerisque, nisl nisi lobortis nisl, ultricies dictum diam neque at felis.</p>
        
        
		<div class="cleaner_h30 horizon_divider"></div>
        <div class="cleaner_h30"></div>
        
        <h2>Testimonials</h2>
          
        <div class="col_w270 float_l">
        
        	<blockquote>
            <p>Aliquam tristique, lectus nec condimentum egestas, neque erat posuere purus, sed interdum elit est ut sem. Proin ut nisl orci.</p>
            
            <cite>Smith - <span>Web Designer</span></cite>
            </blockquote>
        
        </div>
		
		<div class="col_w270 float_l">
        
        	<blockquote>
            <p>In hac habitasse platea dictumst. Ut tortor mi, interdum interdum dapibus eu, aliquam eu dolor. Etiam non tellus risus, in lobortis nunc.</p>
            
            <cite>George - <span>Web Developer</span></cite>
            </blockquote>
        
		</div>
        
    </div>
    
        <?php include("sidebar.php");
		?>
        
		<div class="cleaner"></div>

</div>

    <div class="cleaner"></div>
  
<?php include("footer.php");
?>
