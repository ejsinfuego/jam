<?php

require '../fpdf/fpdf.php';
require '../vendor/autoload.php';
include('../connection.php');
use Carbon\Carbon;


session_start();    

$dateNow = Carbon::now('Asia/Kolkata');


class PDF extends FPDF
{
    function Header()
    {
        $this->setFont('Arial','B',12);
        $this->SetTextColor(0, 100, 0);
        $this->Cell(50);
        $this->Cell(30, 10, 'ORFANEL-MENDOZA DENTAL CLINIC', 0, 0, 'C');
        $this->Ln(5);
        $this->SetTextColor(0, 0, 0);
        $this->setFont('Arial','I',8);
        $this->Cell(50);    
        $this->Cell(30, 10, 'ORTHODONTICS & ESTHETIC DENTISTRY', 0, 0, 'C');
        $this->Ln(10);
        $this->setFont('Arial','B',10);
        $this->Cell(30, 10, 'P. Leelin St., Poblacion', 0, 0, 'L');
        $this->Ln(5);
        $this->Cell(40, 10, 'Tigaon, Camarines Sur', 0, 0, 'L');
        $this->setFont('Arial','B',10);
        $this->Cell(90, 10, 'GLOBE #: 099-888 9533', 0, 0, 'R');
        $this->Ln(5);
        $this->Cell(40, 10, 'SMART # : 0949-186 7344', 0, 0, 'L');
        $this->Cell(90, 10, 'LANDLINE GLOBE #: 0917-104 4106', 0, 0, 'R');
        $this->SetLineWidth(1.0);
        $this->Line('10', '45', '140', '45');
        $this->Line('10', '45', '140', '45');
        $this->Line('10', '45', '140', '45');
        $this->Ln(10);
        //border bottom for header

    }

    function Footer(){
        $this->SetY(-27);
        $this->setFont('Arial','B',10);
        $this->Cell(0,10,'JOSEFINA ELIGIA L. ORFANEL-MENDOZA, DMD',0,0,'R');
        $this->Ln(5);
        $this->setX(55);
        $this->Cell(50,10,'Lic. No. 0041638',0,0,'L');
        $this->Ln(5);
        $this->setX(55);
        $this->Cell(50,10,'PTR No. ',0,0,'L');

    }
}

if($_GET){
    $appointment_id = $_GET['appointment_id'];
    //get patient, appointments, records table
    $patient = $database->query("SELECT * FROM records INNER JOIN appointments ON records.appointment_id = appointments.id INNER JOIN patient ON appointments.patient_id = patient.id WHERE appointments.id = '$appointment_id'"); 
    $patient = $patient->fetch_assoc();
    $age = (isset($patient['age']) ? $patient['age'] : ' ');
    $appointmentTime = date('h:i A', strtotime($patient['appointmentTime']));
    $sex = (isset($patient['sex']) ? $patient['sex'] : ' ');
    $pdf = new PDF('P','mm','A5');
    $pdf->AddPage();
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(70,10,'Name: '.$patient['first_name'].' '.$patient['last_name']);
    //create underline the name
    $pdf->SetLineWidth(0.5);
    $pdf->Line('23', '52', '80', '52');
    $pdf->Cell(40,10,'Age: '.$age);
    $pdf->SetLineWidth(0.5);
    $pdf->Line('90', '52', '120', '52');
    $pdf->Cell(40,10,'Sex: '.ucfirst($sex));
    $pdf->SetLineWidth(0.5);
    $pdf->Line('130', '52', '140', '52');
    $pdf->Ln(8);
    $pdf->Cell(40,10,'Date: '.date('M d, Y', $dateNow->timestamp));
    $pdf->SetLineWidth(0.5);
    $pdf->Line('20', '60', '80', '60');
    $pdf->Ln(10);
    //insert image of rx for prescription
    $pdf->Image('../assets/img/R.png', 10, 65, 25);
    $pdf->Ln(30);
    $prescription = explode('
    ',$patient['prescription']);
    foreach($prescription as $pres){
        $pdf->Ln(5);
        $pdf->Cell(40,10,$pres);
        
    }
    $pdf->Output('D', $patient['first_name'].'-'.$patient['last_name'].'-'.$dateNow.'.pdf');
}

?>