<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Downloads</title>
  <link rel="stylesheet" href="../style.css" type="text/css">
</head>

<body>

  <div id="container">
    <table class="sortable" width=100%>
      <thead>
        <tr>
          <th width=50%>Filename</th>
          <th width=15%>Type</th>
          <th width=15%>Size <small>(bytes)</small></th>
          <th width=20%>Date Modified</th>
        </tr>
      </thead>
      <tbody>
      <?php
        // Opens directory
        $myDirectory=opendir(".");
        
        // Gets each entry
        while($entryName=readdir($myDirectory)) {
          $dirArray[]=$entryName;
        }
        
        // Finds extensions of files
        function findexts ($filename) {
          $filename=strtolower($filename);
          $exts=split("[/\\.]", $filename);
          $n=count($exts)-1;
          $exts=$exts[$n];
          return $exts;
        }
        
        // Closes directory
        closedir($myDirectory);
        
        // Counts elements in array
        $indexCount=count($dirArray);
        
        // Sorts files
        sort($dirArray);
        
        // Loops through the array of files
        for($index=0; $index < $indexCount; $index++) 
			{ if(substr("$dirArray[$index]", 0, 1) != "." and substr("$dirArray[$index]", 0, 5) != "index" ) {
			  // Gets File Names
			  $name=$dirArray[$index];
			  $namehref=$dirArray[$index];
			  
			  // Gets Extensions 
			  $extn=findexts($dirArray[$index]); 
			  
			  // Gets file size 
			  $size=number_format(filesize($dirArray[$index]));
			  
			  // Gets Date Modified Data
			  $modtime=date("M j Y g:i A", filemtime($dirArray[$index]));
			  
			  // Prettifies File Types, add more to suit your needs.
			  switch ($extn){
				case "png": $extn="PNG Image"; break;
				case "jpg": $extn="JPEG Image"; break;
				case "svg": $extn="SVG Image"; break;
				case "gif": $extn="GIF Image"; break;
				case "ico": $extn="Windows Icon"; break;
				case "txt": $extn="Text File"; break;
				case "log": $extn="Log File"; break;
				case "htm": $extn="HTML File"; break;
				case "php": $extn="PHP Script"; break;
				case "js": $extn="Javascript"; break;
				case "css": $extn="Stylesheet"; break;
				case "pdf": $extn="PDF Document"; break;
				case "zip": $extn="ZIP Archive"; break;
				case "bak": $extn="Backup File"; break;
				
				default: $extn=strtoupper($extn)." File"; break;
			  }

				$class="file";

			  // Print the files
			  print("
			  <tr class='$class'>
				<td><a href='./$namehref'>$name</a></td>
				<td>$extn</td>
				<td>$size</td>
				<td>$modtime</td>
			  </tr>");
			  }
        }
      ?>
      </tbody>
    </table>    
  </div>
  
</body>

</html>