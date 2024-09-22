<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Http\Requests\Backend\SEORequest;
use Illuminate\Support\Facades\Storage;

class SeoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      if($request->ajax()){

          $row = Seo::OrderBy('id','desc')->latest();

          return DataTables::of($row)

          ->addIndexColumn()

          ->addColumn('updated_at',function($row){
            return Carbon::parse($row->updated_at)->format('d-m-Y h:i A');
        })

          ->addColumn('description',function($row){
           return Str::limit($row->meta_des ?? '', 30, '..');
       })

        ->addColumn('meta_title',function($row){
           return Str::limit($row->meta_title ?? '', 30, '..');
        })

        ->addColumn('title',function($row){
           return Str::limit($row->title ?? '', 30, '..');
        })

        ->addColumn('image',function($row){
        
            $img='<img src="'.$row->seo_img.'" style="width: 100px;" class="mb-3 view-image bg-light p-2 rounded-2">';
            return $img;
        })

        ->addColumn('action', function($row){
            $btn = '';
            $btn .= '<a href="'.route("backend.seo.edit", $row->id).'" class="edit-record m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Edit"><i class="la la-edit"></i></a>';
            return $btn;
        })

          ->rawColumns(['created_at','action','image','meta_title','title','description'])
          ->make(true);
      }
      return view('backend.seo.index');
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\seo  $seo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\seo  $seo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     $data['record'] = Seo::find($id);
     return view('backend.seo.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\seo  $seo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     
    try{
       
        $seo = Seo::find($id);

        $data = array(
         'title' => json_encode($request->title),
         'meta_title' => json_encode($request->meta_title),
         'meta_des' => json_encode($request->meta_des),
         'meta_keyword' => $request->meta_keyword,
         );

        if($request->hasFile('featured_image')){

            /*--- remove image from folder ---*/

            if(!empty($seo->featured_image) AND Storage::exists('featured_image/'.$seo->featured_image)){

                Storage::delete('featured_image/'.$seo->featured_image);
            }

            $document_path = 'featured_image';

            if (!\Storage::exists($document_path)) {

                \Storage::makeDirectory($document_path, 0777);
            }

            $dark_featured_image = pathinfo($request->file('featured_image')->getClientOriginalName(), PATHINFO_FILENAME).'_featured_image_'.time().'.'.$request->file('featured_image')->getClientOriginalExtension();

            $request->file('featured_image')->storeAs($document_path, $dark_featured_image);

            $data['featured_image'] = $dark_featured_image;
        }

        Seo::where('id',$id)->update($data);

        return redirect()->route('backend.seo.index')->with(['status'=>'success','message'=>'SEO has added successfully.']);
    }catch(\Exception $e){

        return redirect()->route('backend.seo.edit',$id)->with(['status'=>'danger','message'=>'Oop`s somthing wents wrong.']);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\seo  $seo
     * @return \Illuminate\Http\Response
     */
    public function destroy(seo $seo)
    {
        //
    }
}
