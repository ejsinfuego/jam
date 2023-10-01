<?php



require '../fpdf/fpdf.php';
include('../connection.php');
session_start();    

if($_GET){
    $appointment_id = $_GET['appointment_id'];
    //get patient, appointments, records table
    $patient = $database->query("SELECT * FROM records INNER JOIN appointments ON records.appointment_id = appointments.id INNER JOIN patient ON appointments.patient_id = patient.id WHERE appointments.id = '$appointment_id'"); 
    $patient = $patient->fetch_assoc();
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(40,10,'Patient Name: '.$patient['first_name'].' '.$patient['last_name']);
    $pdf->Ln();
    $pdf->Cell(40,10,'Email: '.$patient['email']);
    $pdf->Ln();
    $pdf->Cell(40,10,'Appointment Date:  '.$patient['appointmentDate']);
    $pdf->Ln();
    $pdf->Cell(40,10,'Appoointment Time: '.$patient['appointmentTime']);
    $pdf->Ln();
    $pdf->Cell(40,10,'Prescription: '.$patient['prescription']);
    $pdf->Ln();
    $pdf->Cell(40,10,'Date: '.$patient['created_at']);
    $pdf->Output('D', 'patient.pdf');

}

?>