<?php
    include('db_connect.php');

    // write query for all pizzas
    $sql = 'SELECT title, features, id FROM smartphone ORDER BY created_at';
    
    //make query
    $result = mysqli_query($conn, $sql);
    
    //fetch resulting rows as an entry
    $smartphone = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    //clearing the data
    mysqli_free_result($result);
    
    //closing the connection
    mysqli_close($conn);
?>


<!DOCTYPE html>
<html>
    <?php include('header.php'); ?>
    
    <h4 class = "center grey-text">SMART-PHONES</h4>
    <div class="container">
        <div class="row">
            <?php foreach($smartphone as $smartph){ ?>
                <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <div class="card-content center">
                            <h6><?php echo htmlspecialchars($smartph['title']); ?></h6>
                            <ul>
                                <?php foreach(explode(',', $smartph['features']) as $feat){ ?>
                                    <li><?php echo htmlspecialchars($feat); ?></li>
                                <?php } ?>    
                            </ul>
                        </div>
                        <div class="card-action right-align">
                             <a href="admin.php?id=<?php if($_SESSION['account_type'] == 'admin'){ echo $smartph['id'];} ?>" class = "brand-text">More Info</a>
                        </div> 
                    </div>
                </div>
            <?php } ?>    
        </div>
    </div>

    <?php include('footer.php'); ?>

     
</html>