<?php
require "../connection.php";

$sql='SELECT * FROM passenger';
$data=array();
$statement=$connection->prepare($sql);
$statement->execute();
$passengers=$statement->fetchAll(PDO::FETCH_OBJ);
$bookid=$passengers->booking_id;

while($rows = $statement->fetch(PDO::FETCH_ASSOC))
{
    $data[]=$rows;
}


$sql1='SELECT * FROM booking WHERE id=:id';
$data1=array();
$s=$connection->prepare($sql1);
$s->execute([':id'=>$bookid]);
$booking=$s->fetch(PDO::FETCH_OBJ);
$regid=$booking->register_id;
$flyid=$booking->fly_id;

while($rows1=$s->fetch(PDO::FETCH_ASSOC))
{
    $data1[]=$rows1;
}

$sql2='SELECT * FROM register WHERE id=:id';
$data2=array();
$sta=$connection->prepare($sql2);
$sta->execute([':id'=>$regid]);
$users=$sta->fetch(PDO::FETCH_OBJ);
$name=$users->name;

while($rows2=$sta->fetch(PDO::FETCH_ASSOC))
{
    $data2[]=$rows2;
}

$sql3='SELECT * FROM fly WHERE id=:id';
$data3=array();
$stmnt=$connection->prepare($sql3);
$stmnt->execute([':id'=>$flyid]);
$flys=$stmnt->fetch(PDO::FETCH_OBJ);
$flightid=$flys->flight_id;

while($rows3=$stmnt->fetch(PDO::FETCH_ASSOC))
{
    $data3=$rows3;
}

$query='SELECT * FROM flight WHERE id=:id';
$data4=array();
$st=$connection->prepare($query);
$st->execute([':id'=>$flightid]);
$flights=$st->fetch(PDO::FETCH_OBJ);
$did=$flights->depart_id;
$aid=$flights->arrival_id;

while($rows4=$st->fetch(PDO::FETCH_ASSOC))
{
    $data4=$rows4;
}

$q='SELECT * FROM airport WHERE id=:id';
$data5=array();
$stmt=$connection->prepare($q);
$stmt->execute([':id'=>$did]);
$deps=$stmt->fetch(PDO::FETCH_OBJ);
$dname=$deps->name;

while($rows5=$stmt->fetch(PDO::FETCH_ASSOC))
{
    $data5=$rows5;
}

$q1='SELECT * FROM airport WHERE id=:id';
$data6=array();
$stm=$connection->prepare($q1);
$stm->execute([':id'=>$aid]);
$arrs=$stm->fetch(PDO::FETCH_OBJ);
$aname=$arrs->name;

while($rows6=$stm->fetch(PDO::FETCH_ASSOC))
{
    $data6=$rows6;
}


if(isset($_POST['export']))
{
    $filename="excel".".xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $show_coloumn = false;
    if (!empty($developer_records)) {
        foreach ($developer_records as $record) {
            if (!$show_coloumn) {
                // display field/column names in first row
                echo implode("\t", array_keys($record)) . "\n";
                $show_coloumn = true;
            }
            echo implode("\t", array_values($record)) . "\n";
        }
    }
    exit;
}
