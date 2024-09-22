<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Libraries\Exch;
use App\Models\Order;
use App\Models\Seo;
use App\User;

class HistoryController extends Controller
{
   public function index(){
   
    $user = user();
    $data['record'] = Order::with('get_from_symbol','get_to_symbol')->where('user_id',$user->id)->paginate(5);

     $data['seoData'] = Seo::where('slug','history')->first();
     return view('frontend.history',$data);
   }
}
?>