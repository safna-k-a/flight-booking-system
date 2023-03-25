
<?php
require '../../connection.php';
require '../../header.php';
 if(isset($_POST['flight_name'])&&isset($_POST['departure'])&&isset($_POST['arrival'])&&isset($_POST['departure_date'])
    &&isset($_POST['arrival_date'])&&isset($_POST['departure_time'])&&isset($_POST['arrival_time'])){

        //storing the values in variables
        $name=$_POST['flight_name'];
        $departure=$_POST['departure'];
        $arrival=$_POST['arrival'];
        $departure_date=$_POST['departure_date'];
        $arrival_date=$_POST['arrival_date'];
        $departure_time=$_POST['departure_time'];
        $arrival_time=$_POST['arrival_time'];
        $a='admin';

            //selecting id from flight table with corresponding name
            $sql='SELECT * FROM flight where name=:name LIMIT 1';
            $sta=$connection->prepare($sql);
            $sta->execute([':name'=>$name]);
            $flights=$sta->fetch(PDO::FETCH_OBJ);
            $flightid=$flights->id;

            //selecting id from airport table with corresponding name
            $sql1='SELECT * FROM airport where name=:name LIMIT 1';
            $sta1=$connection->prepare($sql1);
            $sta1->execute([':name'=>$departure]);
            $departures=$sta1->fetch(PDO::FETCH_OBJ);
            $deptid=$departures->id;

            //selecting name of arrival airport
            $sql2='SELECT * FROM airport where name=:name LIMIT 1';
            $sta2=$connection->prepare($sql2);
            $sta2->execute([':name'=>$arrival]);
            $arrivals=$sta2->fetch(PDO::FETCH_OBJ);
            $arrivalid=$arrivals->id;

            $sql='SELECT * FROM fly WHERE flight_id=:f_id AND depart_id=:d_id AND depart_date=:d_date AND depart_time=:d_time';
            $sta=$connection->prepare($sql);
            $sta->execute([':f_id'=>$flightid,':d_id'=>$deptid,':d_date'=>$departure_date,':d_time'=>$departure_time]);
            $q_check=$sta->fetch(PDO::FETCH_OBJ);
            if($q_check)
            {
            echo "<script>
                Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Route already exists!',
                showConfirmButton: false,
                timer: 2000
              }).then(function(){
                window.location='update.php';
              });

            </script>";    
            }
            else
            {
                         //inserting into the db
            $sql='INSERT INTO fly(flight_id,depart_id,arrival_id,arr_date,depart_date,arr_time,depart_time,created_by)
            VALUES(:flight_id,:depart_id,:arrival_id,:arr_date,:depart_date,:arr_time,:depart_time,:created_by)';
        $statement=$connection->prepare($sql);
        $s=$statement->execute([':flight_id'=>$flightid,':depart_id'=>$deptid,':arrival_id'=>$arrivalid,':arr_date'=>$arrival_date,
            ':depart_date'=>$departure_date,':arr_time'=>$arrival_time,':depart_time'=>$departure_time,':created_by'=>$a]);
        if($s)
        {
            echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'New Route Added',
            showConfirmButton: false,
            timer: 2000
          }).then(function(){
            window.location='add.php';
          });

        </script>";
        }

            }

           
    }
?>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-10 min-vh-100 mt-3">
        <form
                    action=""
                    method="POST" onsubmit="return fvalidate()"
                    class="form-control p-5 w-75 mx-auto my-2 dark bg-opacity-50 mt-5"
                    enctype="multipart/form-data"
                >
                    <div class="form-floating mb-3">
                        <?php
                            $sql='SELECT name FROM flight';
                            $sta=$connection->prepare($sql);
                            $sta->execute();
                            $flights=$sta->fetchAll(PDO::FETCH_OBJ);

                        ?>
                        <select name="flight_name" id="flight_name" class="form-control" aria-label="Default select example">
                        <option value="">Select Flight Name</option>
                        <?php 
                            $i=1;
                            foreach($flights as $flight): ?>
                            <option value="<?=$flight->name;?>"><?=$flight->name?></option>
                            <?php $i=$i+1;
                            endforeach; ?>
                        </select>
                    </div>
                    <div class="form-floating mb-3">
                    <?php
                            $sql='SELECT name FROM airport';
                            $sta=$connection->prepare($sql);
                            $sta->execute();
                            $airports=$sta->fetchAll(PDO::FETCH_OBJ);

                        ?>
                        <select name="departure" id="departure_a" class="form-control" aria-label="Default select example">
                        <option value="">Departure</option>
                        <?php 
                            $i=1;
                            foreach($airports as $airport): ?>
                            <option value="<?=$airport->name;?>"><?=$airport->name?></option>
                            <?php $i=$i+1;
                            endforeach; ?>
                        </select>
                    </div>
                    <div class="form-floating mb-3">
                    <?php
                            $sql='SELECT name FROM airport';
                            $sta=$connection->prepare($sql);
                            $sta->execute();
                            $airs=$sta->fetchAll(PDO::FETCH_OBJ);

                        ?>
                        <select name="arrival" id="arrival_a" class="form-control" aria-label="Default select example">
                        <option value="">Arrival</option>
                        <?php 
                            $i=1;
                            foreach($airs as $air): ?>
                            <option value="<?=$air->name?>"><?=$air->name?></option>
                            <?php $i=$i+1;
                            endforeach; ?>
                        </select>
                    </div>
                    <div class="form-floating mb-3">
                        <input
                            type="date"
                            class="form-control"
                            placeholder=""
                            id="departure_date"
                            name="departure_date"
                        />
                        <label for="departure_date" class="form-label">Departure date</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input
                            type="date"
                            class="form-control"
                            placeholder=""
                            id="arrival_date"
                            name="arrival_date"
                        />
                        <label for="arrival_date" class="form-label">Arrival date</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input
                            type="time"
                            class="form-control"
                            placeholder=""
                            id="departure_time"
                            name="departure_time"
                        />
                        <label for="departure_time" class="form-label">Departure time</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input
                            type="time"
                            class="form-control"
                            placeholder=""
                            id="arrival_time"
                            name="arrival_time"
                        />
                        <label for="arrival_time" class="form-label">Arrival time</label>
                    </div>
                    <div class="text-center">
                        <input
                            type="submit"
                            value="Add New Route"
                            class="bg-primary px-3 py-2 rounded-2 text-light border-0"
                        />
                    </div>
                </form>  
        </div>
    </div>
    </div>
            <?php
        require '../../footer.php';
    ?>
