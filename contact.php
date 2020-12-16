<?php include("header.php");
?>
<div id="tooplate_main">
    
    <div id="tooplate_content">

            <h2>Contact Information</h2>

        <p><em>In ac libero urna. Suspendisse sed odio ut mi auctor blandit. Duis luctus nulla metus, a vulputate mauris. Integer sed nisi sapien, ut gravida mauris.</em></p>
        <p>Nam et tellus libero. Cras purus libero, dapibus nec rutrum in, dapibus nec risus. Ut interdum mi sit amet magna feugiat auctor. Validate <a href="http://validator.w3.org/check?uri=referer" rel="nofollow"><strong>XHTML</strong></a> and <a href="http://jigsaw.w3.org/css-validator/check/referer" rel="nofollow"><strong>CSS</strong></a>.</p>
        <div class="cleaner_h40"></div>
        
        <div class="two_column_ws float_l">
            
           		<h6>Location One</h6>
                225-880 Quisque odio quam, <br />
                Pulvinar sit amet convallis eget, 10110<br />
                Venenatis ut turpis<br /><br />
                Tel: 020-050-5520<br /> 
                Fax: 020-040-1680
                </div>
                
                <div class="two_column_ws float_r">
           
                <h6>Location Two</h6>
                161-832 Duis lacinia dictum, <br />
                Ipsum vestibulum, 10510<br />
                Diam a mollis tempor<br /><br />
                Tel: 040-060-4520<br />
                Fax: 040-020-3560 
            </div>       
        
            <div class="cleaner_h50"></div>
            
            <div id="contact_form">
            
				<h4>Quick Contact Form</h4>
					<form method="post" name="contact" action="#">
					
						<label for="author">Name:</label> <input type="text" id="author" name="author" class="required input_field" />
						<div class="cleaner_h10"></div>
													
						<label for="email">Email:</label> <input type="text" class="validate-email required input_field" name="email" id="email" />
						<div class="cleaner_h10"></div>
											
						<label for="subject">Subject:</label> <input type="text" class="validate-subject required input_field" name="subject" id="subject"/>				               
						<div class="cleaner_h10"></div>
							
						<label for="text">Message:</label> <textarea id="text" name="text" rows="0" cols="0" class="required"></textarea>
						<div class="cleaner_h10"></div>				
												
						<input type="submit" value="Send" id="submit" name="submit" class="submit_btn float_l" />
						<input type="reset" value="Reset" id="reset" name="reset" class="submit_btn float_r" />
						
					</form>
			</div>           
            
    </div>
    
       <?php include("sidebar.php");
	   ?>
            
            
        
		<div class="cleaner"></div>

</div>

    <div class="cleaner"></div>  

<?php include("footer.php");
?>
