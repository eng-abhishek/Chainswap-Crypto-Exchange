<?php

use Illuminate\Database\Seeder;
use App\Models\AboutUs;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
      if(AboutUs::where('slug','about-us')->count() > 0){
         
       }else{
          $data = array(
                      'slug'=>'about-us'
                       );
          AboutUs::insert($data);
       }
    }
}
