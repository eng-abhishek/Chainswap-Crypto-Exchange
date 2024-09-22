<?php

use Illuminate\Database\Seeder;
use App\Models\Seo;

class SEOSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           $data = [
                  ['slug' => 'home'],
                  ['slug' => 'about-us'],
                  ['slug' => 'contact_us'],
                  ['slug' => 'faq'],
                  ['slug' => 'reviews'],
                  ['slug' => 'order'],
                  ['slug' => 'terms_condition'],
                  ['slug' => 'privacy_policy'],
                  ['slug' => 'crypto-pairs'],
                  ['slug' => 'history'],
                  ['slug' => 'exchange'],
                  ['slug' => 'exchange-detail'],
                  ['slug' => 'how-it-work'],
                ];
 
      foreach ($data as $key => $value) {
        
        if(Seo::where('slug',$value['slug'])->count()>0){
         // Seo::where('slug',$value['slug'])->update($data[$key]);
        }else{
            
           Seo::insert($data[$key]);

        }
      }
    }
}
