<?php
	require 'header.php';
	require 'menu.php';
	require 'lsidebar.php';
?>    
					
			<div class="column middle">
				<h3>Notice</h3><hr>
				<p> 
				<?php
					include("db.php");
					$sql = "SELECT * FROM notice";
					$result = mysqli_query($conn, $sql);
					
					// output data of each row
					echo "<ul>";
					while($row = mysqli_fetch_assoc($result)) {
						echo "<li><a href='noticeView.php?id=".$row["id"]."'>";
						echo $row["title"];
						echo "</a></li>";
					}					
					echo "</ul>";
					mysqli_close($conn);
				?>
				</p>  
			</div>

<?php
	require 'rsidebar.php';
	require 'footer.php';
?>			
