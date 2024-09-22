<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Libraries\Exch;

class DashboardController extends Controller
{
	    public function __construct() {
        $this->exch = new Exch();
        }

   public function index(){
       
        $data['total_order'] = Order::count();
        $data['waiting'] = Order::where('state','Waiting')->count();
        $data['completed'] = Order::where('state','Completed')->count();
        $data['cancelled'] = Order::where(['state'=>'Cancelled','state'=>''])->count();

         return view('backend.dashboard',$data);
   }
}
?>