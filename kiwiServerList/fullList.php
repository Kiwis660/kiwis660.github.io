<?php

  require 'header.php';
  require 'settings.php';

  if(isset($_SESSION['userId'])){
    $userId = $_SESSION['userId'];

    $adminSql = "SELECT * FROM users WHERE idUsers = " . $userId;
    $adminResult = $conn->query($adminSql);
    $adminRow = $adminResult->fetch_assoc();
    if($adminRow['role'] == "ADMIN"){
?>

<main class="indexMain">
  <nav class="navbar navbar-light bg-light">
  <form class="form-inline" action="fullList">
    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
</nav>
  <div class="indexDiv">

  <table class="table table-hover">
  <thead class="thead-dark">
    <tr>
      <form class="form-inline" action="fullList">
        <th scope="col">#</th>
        <th scope="col">Server Name</th>
        <th scope="col">Type</th>
        <th scope="col">Language</th>
        <th scope="col">Votes</th>
        <th scope="col">Info</th>
        <th scope="col">Status</th>
      </form>
    </tr>
  </thead>
  <tbody>
    <?php
    $search = "";
    if(isset($_GET['search'])){
      $search = $_GET['search'];
    }
    $strSQL = "SELECT * FROM servers WHERE serverName LIKE '%$search%'";
    $rs = mysqli_query($conn,$strSQL);
    $number_of_results = mysqli_num_rows($rs);
    $number_of_pages = ceil($number_of_results/$results_per_page);

    if(!isset($_GET['page'])){
      $page = 1;
    }else{
      $page = $_GET['page'];
    }

    $this_page_first_result = ($page-1)*$results_per_page;

    $sql = "SELECT * FROM servers WHERE serverName LIKE '%$search%' LIMIT " . $this_page_first_result . "," . $results_per_page;
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
      <?php
      if($row['confirmed'] == 1){
        echo '<td class="vote"><a  href="serverInfo?id=' . $row['idServer']. '" class="btn btn-success" role="button">GOOD</a></td>';
      }else if($row['confirmed'] == 2){
        echo '<td class="vote"><a href="serverInfo?id=' . $row['idServer']. '" class="btn btn-danger" role="button">BLOCKED</a></td>';
      }else{
        echo '<td class="vote"><a href="serverInfo?id=' . $row['idServer']. '" class="btn btn-warning" role="button">UNCONFIRMED</a></td>';
      }
       ?>
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

<script type="text/javascript">

</script>

<?php
}else{
  header("Location: index");
  exit();
}

}else{
header("Location: index");
exit();
} ?>
