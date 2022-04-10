<?php
	require 'header.php';
	require 'menu.php';
	require 'lsidebar.php';
?>    
					
			<div class="column middle">
				<h3>Teacher</h3><hr>
				<p> 
				<?php
					include("db.php");
					$sql = "SELECT * FROM teachers";
					$result = mysqli_query($conn, $sql);
					
					// output data of each row
					while($row = mysqli_fetch_assoc($result)) {
						echo "<table>";
						
						echo "<tr><th>id</th>";
						echo "<td>:</td>";
						echo "<td>".$row["id"]."</td></tr>";
						
						echo "<tr><th>Name</th>";
						echo "<td>:</td>";
						echo "<td>".$row["name"]."</td></tr>";
						
						echo "<tr><th>Designation</th>";
						echo "<td>:</td>";
						echo "<td>".$row["designation"]."</td></tr>";
						
						echo "<tr><th>Joining Datae</th>";
						echo "<td>:</td>";
						echo "<td>".$row["joiningdate"]."</td></tr>";
						
						echo "<tr><th>Email</th>";
						echo "<td>:</td>";
						echo "<td>".$row["email"]."</td></tr>";
						
						echo "<tr><th>Country</th>";
						echo "<td>:</td>";
						echo "<td>".$row["country"]."</td></tr>";
						
						echo "<tr><th>Other</th>";
						echo "<td>:</td>";
						echo "<td>".$row["other"]."</td></tr>";	
						
						echo "</table><br><hr>";
					}					
					mysqli_close($conn);
				?>
				</p> 
			</div>

<?php
	require 'rsidebar.php';
	require 'footer.php';
?>			
