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
					$tid = $_GET['id'];
					$sql = "SELECT * FROM notice WHERE id='$tid'";
					
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($result);
					
					echo "<table>";
						
					echo "<tr><th>id</th>";
					echo "<td>:</td>";
					echo "<td>".$row["id"]."</td></tr>";
						
					echo "<tr><th>Notice Title</th>";
					echo "<td>:</td>";
					echo "<td>".$row["title"]."</td></tr>";
						
					echo "<tr><th>Description</th>";
					echo "<td>:</td>";
					echo "<td>".$row["description"]."</td></tr>";
						
					echo "<tr><th>last Data</th>";
					echo "<td>:</td>";
					echo "<td>".$row["lastdate"]."</td></tr>";
						
					echo "<tr><th>file</th>";
					echo "<td>:</td>";
					echo "<td>";
					if($row["filepath"]!=""){
						echo "<a href = '".$row["filepath"]."'>";
						echo "file download";
						echo "</a>";
					}
					else
						echo "No file";
					echo "</td></tr>";
						
					echo "</table><br><hr>";
					mysqli_close($conn);
				?>
				</p>  
			</div>

<?php
	require 'rsidebar.php';
	require 'footer.php';
?>			
