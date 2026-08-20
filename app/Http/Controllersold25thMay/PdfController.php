<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
class PdfController extends Controller
{

	/**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function createPDF(Request $request)
    {

    	 
        // set certificate file
        $certificate = 'file://'.base_path().'/public/tcpdf.crt';

        

        // set additional information in the signature
        $info = array(
            'Name' => 'TCPDF',
            'Location' => 'Office',
            'Reason' => 'Testing TCPDF',
            'ContactInfo' => 'http://www.tcpdf.org',
        );

        // set document signature
        PDF::setSignature($certificate, $certificate, 'tcpdfdemo', '', 2, $info);
        
        PDF::SetFont('helvetica', '', 12);
        PDF::SetTitle('Hello World');
        PDF::AddPage();

        // print a line of text
        $text = view('tcpdf');

        // add view content
        PDF::writeHTML($text, true, 0, true, 0);

        // add image for signature
        $signed_image = 
        $a = PDF::Image('tcpdf.png', 180, 60, 15, 15, 'PNG');
        echo $a;die;
        // define active area for signature appearance
        PDF::setSignatureAppearance(180, 60, 15, 15);
        
        // save pdf file
        PDF::Output(public_path('hello_world.pdf'), 'F');

        PDF::reset();

        dd('pdf created');
    }
}
