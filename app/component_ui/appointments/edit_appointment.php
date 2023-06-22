<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Appointment</title>
</head>

<body>



    <div class='editAppointment_wrap'>
        <?php

        include 'config.php';

echo '<h1>Edit Appointment</h1>';

echo '<form action="../../component_crud/appointment/update_appointment.php?id='.$_GET['id']. '" method="POST">';

echo '<input name="id" type="text" readonly ';
if(isset($_GET['id'])){
echo 'value="'.$_GET['id'].'"';
}
echo '/>';

echo '<div>Receptionist</div>';
echo '<input name="edit_receptionist" type="text" readonly ';
if(isset($_GET['receptionist'])){
echo 'value="'.$_GET['rec_id'].'"';
}
echo '/>';

echo '<br/>';
echo '<br/>';


// Patient drop down with selected appoinment on select
echo '<div>Patients</div>';
$sql_patient = "select *, ptnt.patient_name
from therapysession session, patient ptnt
where session.patient_id=ptnt.patient_id";

$result = $con -> query($sql_patient);

echo '<select name="edit_patient" key="">';
while($patient = $result->fetch_assoc()) {
        if ($_GET['pat_id'] == $patient['patient_id'])
        {
            echo '<option selected value="'.$patient['patient_id'].'">'.$patient['patient_name'].'</option>';
        }else{
            echo '<option value="'.$patient['patient_id'].'">'.$patient['patient_name'].'</option>';
        }
}
echo "</select>";


// Patient drop down with selected appoinment on select
echo '<div>Doctor</div>';
$sql_doctor = "select *, dctr.doctor_name
from therapysession session, doctors dctr
where session.doctor_id=dctr.doctor_id";

$result_doc = $con -> query($sql_doctor);

echo '<select name="edit_doctor" key="">';
while($doctor = $result_doc->fetch_assoc()) {
        if ($_GET['doc_id'] == $doctor['doctor_id'])
        {
            echo '<option selected value="'.$doctor['doctor_id'].'">'.$doctor['doctor_name'].'</option>';
        }else{
            echo '<option  value="'.$doctor['doctor_id'].'">'.$doctor['doctor_name'].'</option>';
        }
}
echo "</select>";


// Date picker with init date
echo '<div>Date</div>';
echo '<input type="date" name="edit_date" value="2023-06-06" id="appointment_date"/>';


// Time slots
echo '<div>Time</div>';

$sql_time = "select *
from therapysession session
where session.session_time=session.session_time";

$result_time = $con -> query($sql_time);

$therapy_time_slots = array("09:00", "10:05", "11:05", "13:00", "14:05", "15:05");
echo '<select name="edit_session_time">';

if($sessTime = $result_time->fetch_assoc()){
    for($t = 0; $t <= (count($therapy_time_slots)-1); $t++){
        if ($_GET['session_time'] == $therapy_time_slots[$t]){
            echo '<option selected value"'.$therapy_time_slots[$t].'" >'.$therapy_time_slots[$t].'</option>';
        }else{
        echo '<option value"'.$therapy_time_slots[$t].'" >'.$therapy_time_slots[$t].'</option>';
        }
    };
}

echo '</select>';

echo '<br/>';
echo '<br/>';





// Session Room
echo '<div>Room</div>';

$sql_room = "select *
from therapysession session
where session.session_room=session.session_room";

$result_room = $con -> query($sql_time);

$therapy_rooms = array("A1", "A2", "B1", "B2", "C1", "C2");
echo '<select name="edit_session_room">';

if($sessRoom = $result_room->fetch_assoc()){
    for($r = 0; $r <= (count($therapy_rooms)-1); $r++){
        if ($_GET['session_room'] == $therapy_rooms[$r]){
            echo '<option selected value"'.$therapy_rooms[$r].'" >'.$therapy_rooms[$r].'</option>';
        }else{
        echo '<option value"'.$therapy_rooms[$r].'" >'.$therapy_rooms[$r].'</option>';
        }
    };
}

echo '</select>';




// Attendence status
echo '<div>Attendance</div>';

$sql_attended = "select *
from therapysession session
where session.attended=session.attended";

$result_attended = $con -> query($sql_attended);
$therapy_attended = array("Attended","Pending", "Postponed - Doc", "Postponed - Pat");

echo '<select name="edit_attended">';

if($sessAttended = $result_attended->fetch_assoc()){
    for($a = 0; $a <= (count($therapy_attended)-1); $a++){
        if ($_GET['attended'] == $therapy_attended[$a]){
            echo '<option selected value"'.$therapy_attended[$a].'" >'.$therapy_attended[$a].'</option>';
        }else{
        echo '<option value"'.$therapy_attended[$a].'" >'.$therapy_attended[$a].'</option>';
        }
    };
}


// <option>Attended</option> <option selected>Pending</option> <option>Postponed</option> 
echo '</select>';

echo '<br/>';
echo '<br/>';



echo '<div>';
echo '<a href="../../index.php?id='.$_GET["id"].'"  role="button"><button role="button">Save changes</button><a/>';
echo '<a href="../index.php"><button id="cancelBtn_edit-appointment">Cancel</button></a>';
echo '</div>';

$con -> close();

echo "</form>";
?>

    </div>

    <script type="text/javascript">
    // const cancelBtn = document.querySelector("#cancelBtn_edit-appointment")
    // cancelBtn.addEventListener("click", goBack)

    // async function goBack(e) {
    //     window.history.back()
    // }

    // const date = document.querySelector("#appointment_date")
    // date.addEventListener("change", showDate)

    // async function showDate(e) {
    //     console.log(e.target.value)
    // }
    </script>

</body>

</html>