<?php

use Illuminate\Database\Seeder;
use App\Models\CustomPage;

class CustomPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {              
        $data = [
                   ['slug'=>'privacy_policy',
		             'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium quos consequatur fuga placeat perferendis, temporibus dolor ex, hic dolorem distinctio reiciendis odio, doloribus magnam est totam iusto repellat doloremque! Ex sunt necessitatibus corrupti animi accusantium odit earum possimus officia, non delectus voluptates adipisci molestias nemo. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corrupti voluptates doloribus exercitationem id eius officia laboriosam. Itaque beatae, praesentium culpa nam, quos similique mollitia incidunt aliquam rerum illum earum cum est exercitationem voluptatum dicta autem eum officia, expedita alias? Tempore architecto labore ipsa atque. Debitis, reiciendis odit, quasi amet explicabo a quam veniam iste repellat quod nobis blanditiis porro? Quae tempore dicta recusandae praesentium necessitatibus.' ],

                    ['slug'=>'terms_condition',
                     'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium quos consequatur fuga placeat perferendis, temporibus dolor ex, hic dolorem distinctio reiciendis odio, doloribus magnam est totam iusto repellat doloremque! Ex sunt necessitatibus corrupti animi accusantium odit earum possimus officia, non delectus voluptates adipisci molestias nemo. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corrupti voluptates doloribus exercitationem id eius officia laboriosam. Itaque beatae, praesentium culpa nam, quos similique mollitia incidunt aliquam rerum illum earum cum est exercitationem voluptatum dicta autem eum officia, expedita alias? Tempore architecto labore ipsa atque. Debitis, reiciendis odit, quasi amet explicabo a quam veniam iste repellat quod nobis blanditiis porro? Quae tempore dicta recusandae praesentium necessitatibus.' ],
                ];

      foreach ($data as $key => $value) {
        if(CustomPage::where('slug',$data[$key]['slug'])->count()>0){

        }else{

           CustomPage::insert($data[$key]);
        }
      }
    }
}
