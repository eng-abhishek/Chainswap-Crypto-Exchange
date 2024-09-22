<?php
namespace App\Http\Controllers\Backend;
use App\Models\AboutUs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\AboutRequest;
use DataTables;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = AboutUs::select('*');
            return Datatables::of($data)
            ->addIndexColumn()
            
            ->addColumn('description',function($row){
             
             return Str::limit(strip_tags($row->description),100,'...');

            })

            ->addColumn('title',function($row){

            return Str::limit(strip_tags($row->title),100,'...');

            })

            ->addColumn('action', function($row){
                $btn = '';
                $btn .= '<a href="'.route("backend.aboutus.edit", $row->id).'" class="edit-record m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Edit"><i class="la la-edit"></i></a>';
                return $btn;
            })
            ->addColumn('updated_at', function($row){
                return ($row->updated_at != '')?Carbon::parse($row->updated_at)->format('Y-m-d h:i:s'):'';
            })
            ->rawColumns(['action','description','title'])
            ->make(true);
        }
        return view('backend.cms.aboutus.index');
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
     * @param  \App\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data['record'] = AboutUs::find($id);
      return view('backend.cms.aboutus.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     try {
            AboutUs::where('id', $id)->update([
                'title' => json_encode($request->get('title')),
                'description' => json_encode($request->get('description')), 
            ]);

            return redirect()->route('backend.aboutus.index')->with(['status' => 'success', 'message' => 'About Us updated successfully.']);

        } catch (\Exception $e) {
            return redirect()->route('backend.aboutus.edit',$id)->with(['status' => 'danger', 'message' => 'Something went wrong, please try again.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function destroy(AboutUs $aboutUs)
    {
        //
    }
}
