<?php
    session_start();
    require '../connection.php';
    require '../header.php';

    $email=$_SESSION['email'];
    $sql='SELECT * FROM register WHERE email=:mail';
    $sta=$connection->prepare($sql);
    $sta->execute([':mail'=>$email]);
    $users=$sta->fetch(PDO::FETCH_OBJ);
    $userid=$users->id;
    
    $sql='SELECT * FROM booking WHERE register_id=:id';
    $sta=$connection->prepare($sql);
    $sta->execute([':id'=>$userid]);
    $bookings=$sta->fetchAll(PDO::FETCH_OBJ);
    
?>

<div class="container-fluid mt-5 mb-5 row justify-content-center">
<div class="col-md-9 col-10 mt-5 p-5 table-responsive " style="height:470px">
    <table class="table table-primary table-striped">
        <thead>
            <tr>
                <th>
                    Flight Name
                </th>
                <th>
                    Departure
                </th>
                <th>
                    Arrival
                </th>
                <th>
                    Departure Date
                </th>
                <th>
                    Arrival Date
                </th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i=1;
            foreach($bookings as $booking): ?>
            
            <tr>
                <?php
                    $bookingid=$booking->id;
                    $sql1='SELECT * FROM fly WHERE id=:id';
    $sta=$connection->prepare($sql1);
    $sta->execute([':id'=>$bookingid]);
    $flys=$sta->fetch(PDO::FETCH_OBJ);
    $flyid=$flys->id;
    $depid=$flys->depart_id;
    $arid=$flys->arrival_id;
    
    $sql='SELECT * FROM flight WHERE id=:id';
    $st=$connection->prepare($sql);
    $st->execute([':id'=>$flyid]);
    $flights=$st->fetch(PDO::FETCH_OBJ);
    $flightname=$flights->name;
    
    
    $sql='SELECT * FROM airport WHERE id=:id';
    $sta=$connection->prepare($sql);
    $sta->execute([':id'=>$depid]);
    $departures=$sta->fetch(PDO::FETCH_OBJ);
    $depname=$departures->name;
                    
    $sql='SELECT * FROM airport WHERE id=:id';
    $sta=$connection->prepare($sql);
    $sta->execute([':id'=>$arid]);
    $arrivals=$sta->fetch(PDO::FETCH_OBJ);
    $arrname=$arrivals->name;
                ?>
                <td>
                    <?=$flightname?>
                    </td>
                <td>
                    <?=$depname?>
                    </td>
                <td>
                    <?=$arrname?>
                    </td>
                <td>
                <?=$flys->depart_date?>
                </td>
                <td>
                    <?=$flys->arr_date?>
                    </td>
                <td>
                    <a href="delete.php"class="btn btn-danger"onclick="return confirm('Are you sure?');">Cancel</a>
                </td>
                 <?php
                    $i=$i+1;
                    endforeach; ?>
                    
             </tr> 
        </tbody>
    </table>
</div> 
</div>
<?php

    require '../../footer.php';
?>