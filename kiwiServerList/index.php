<?php

  require 'header.php';
  require 'settings.php';


?>

<main class="indexMain">
  <div class="indexDiv">

  <table class="table table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Server Name</th>
      <th scope="col">Type</th>
      <th scope="col">Language</th>
      <th scope="col">Votes</th>
      <th scope="col">Info</th>
    </tr>
  </thead>
  <tbody>
    <?php

    $strSQL = "SELECT * FROM servers WHERE confirmed=1";
    $rs = mysqli_query($conn,$strSQL);
    $number_of_results = mysqli_num_rows($rs);
    $number_of_pages = ceil($number_of_results/$results_per_page);

    if(!isset($_GET['page'])){
      $page = 1;
    }else{
      $page = $_GET['page'];
    }

    $this_page_first_result = ($page-1)*$results_per_page;

    $sql = "SELECT * FROM servers WHERE confirmed=1 ORDER BY votes DESC LIMIT " . $this_page_first_result . "," . $results_per_page;
    $result = mysqli_query($conn,$sql);
      $num = $this_page_first_result;
      while($row = mysqli_fetch_array($result)){
      $num++;
    ?>
    <tr>
      <a href="#">
      <td class="nr"><span class="ridgeSpanDecoration"><?=$num?></span></td>
      <td class="serverName"><a> <?=$row['serverName']?></a></td>
      <td class="type"><?=$row['type']?></td>
      <td class="country"><?=$row['language']?></td>
      <td class="country"><?=$row['votes']?></td>
      <td class="vote"><a  href="serverInfo?id=<?=$row['idServer']?>" class="btn btn-outline-info" role="button">More...</a></td>
      </a>
    </tr>
    <?php
  }
      print "</table>";
      if($number_of_pages > 1){
    ?>
    <nav aria-label="Page navigation example">

      <ul class="pagination justify-content-center">
        <?php
        if($page > 1){
          echo '<li class="page-item"><a class="page-link" href="?page=' . ($page-1) . '">Previous</a></li>';
        }
        for($i = 1; $i <= $number_of_pages; $i++){
          echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">'. $i .'</a></li>';
        }
        if(!($page == $number_of_pages)){
          echo '<li class="page-item"><a class="page-link" href="?page=' . ($page+1) . '">Next</a></li>';
        }
        ?>
      </ul>
      </nav>
        <?php } ?>
  </tbody>
</table>

  </div>
</main>
