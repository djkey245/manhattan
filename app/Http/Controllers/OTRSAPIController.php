<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class OTRSAPIController extends Controller
{
    public function index(){

        require('Class/OTRSAPI.php');
        $otrs = new OTRSAPI('http://otrs.softgroup.ua/otrs/rpc.pl','djkey245','Pk5awIDtkf63zfPL');
        $client = new \SoapClient(null, array(
            'location'  => 'http://otrs.softgroup.ua/otrs/index.pl',
            'uri'       => "Core",
            'trace'     => 1,
            'login'     => 'djkey245',
            'password'  => 'Pk5awIDtkf63zfPL',
            'style'     => SOAP_RPC,
            'use'       => SOAP_ENCODED));
        $username = 'djkey245';
        $password = 'Pk5awIDtkf63zfPL';
        $TicketID = '809';
         $otrs->getTicket($TicketID);

dd($otrs->getTicket($TicketID));

    }

}
