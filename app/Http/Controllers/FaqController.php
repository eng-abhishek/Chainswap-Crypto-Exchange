<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Libraries\Exch;
use App\Libraries\Godex;
use App\Models\Coin;
use App\Models\Seo;
use App\Models\Faq;
use App\User;

class FaqController extends Controller
{

    public function __construct()
    {
     // $this->middleware('auth');
      $this->godex = new Godex();
    }

   public function index(){
         
      $data['seoData']= Seo::where('slug','faq')->first();
      $data['record'] = Faq::where('page_type','faq-page')->orWhere('page_type','all')->paginate(5);
      return view('frontend.faq',$data);
   }

   public function details($slug){
    
    $data['seoData'] = Seo::where('slug','faq')->first();
    $data['record'] = Faq::where(['slug'=>$slug,'page_type'=>'faq-page'])->first();
    return view('frontend.faq-detail',$data);
   }


}
?>