<div id="tooplate_sidebar" style="top:0px">
        
            <h2>Our Services</h2>
            
            <ul class="tooplate_list">
            <?php
			$sqlinsurance_type = "SELECT * FROM insurance_type where status='Active'";
			$qsqlinsurance_type = mysqli_query($con,$sqlinsurance_type);
			while($rsinsurancy_type = mysqli_fetch_array($qsqlinsurance_type))
			{
            	echo "<li><a href='insuranceschemeinfo.php?insurancetypeid=$rsinsurancy_type[insurance_type_id]'>$rsinsurancy_type[insurance_type]</a></li>";
			}
            ?>
            </ul>
           
        </div>