<?php

namespace App\Http\Controllers\SchoolPartnerController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class liveDetailSchoolPartnerControler extends Controller
{
    public function detail()  {
        return view('frontEnd.schoolPartner.liveDetail.index');
    }
}
