<!-- Footer -->
<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span><?php
                     $sql = "SELECT * FROM settings";
                     $result = mysqli_query($conn, $sql) or die("Query Failed.");
                     if(mysqli_num_rows($result) > 0){
                         while($row = mysqli_fetch_assoc($result)) {

                            echo $row['footerdesc'];
                         }
                     }
                ?></span>
            </div>
        </div>
    </div>
</div>
<!-- /Footer -->
</body>
</html>
