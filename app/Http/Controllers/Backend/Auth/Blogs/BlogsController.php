<?php

namespace App\Http\Controllers\Backend\Auth\Blogs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blogs;
class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blogs::latest()->get();
        return view('backend.auth.blogs.index', compact("blogs"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.auth.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // $imageName = "";
        // if($request->hasFile('blog_image'))
        // {
        //     $rand=rand();
        //     $imageName = $rand.'.'.$request->file('blog_image')->getClientOriginalExtension();
           
        //     $check=filesize($request->file('blog_image'));
            
        //     $request->file('blog_image')->move(public_path('uploads/blogs'), $imageName);
        //     $imageName = "uploads/blogs/".$imageName;
        // }

        $blog                               = new Blogs;
        $blog->user_id                      = auth()->user()->id ;
        $blog->blog_slug                     = SELF::getUniqueSlug($request->blog_heading);
        $blog->blog_heading                 = $request->blog_heading ;
        $blog->blog_sub_heading             = $request->blog_sub_heading ;
        $blog->blog_text                    = $request->blog_text ;
        // $blog->blog_image                   = $imageName ;
        $blog->save();
        return  redirect()->route('admin.auth.blogs.index')->withFlashSuccess(__('alerts.backend.blogs.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blogs::where("blog_slug", $id)->first();  
         return view('backend.auth.blogs.show')
            ->withBlog($blog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blogs::find($id);
        return view('backend.auth.blogs.edit')
            ->withBlog($blog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $blog   = Blogs::find($id);
        if($blog)
        {
            // $imageName = $blog->blog_image;
            // if($request->hasFile('blog_image'))
            // {
            //     $rand=rand();
            //     $imageName = $rand.'.'.$request->file('blog_image')->getClientOriginalExtension();
               
            //     $check=filesize($request->file('blog_image'));
                
            //     $request->file('blog_image')->move(public_path('uploads/blogs'), $imageName);
            //     $imageName = "uploads/blogs/".$imageName;
            // }

            
            $blog->blog_slug                            = SELF::getUniqueSlug($request->blog_heading);
            $blog->blog_heading                 = $request->blog_heading ;
            $blog->blog_sub_heading             = $request->blog_sub_heading ;
            $blog->blog_text                    = $request->blog_text ;
            // $blog->blog_image                   = $imageName ;
            $blog->save();
            return  redirect()->route('admin.auth.blogs.index')->withFlashSuccess(__('alerts.backend.blogs.updated'));
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blogs::find($id);
        $blog->delete();
        return  redirect()->route('admin.auth.blogs.index')->withFlashSuccess(__('alerts.backend.blogs.deleted'));

    }

    public function getUniqueSlug($slug)
    {
        $i = 1;
        $baseSlug = $slug;
        $slug = strtolower((preg_replace('/[^A-Za-z0-9-]+/', '-', $slug)));
        while(SELF::slug_exist($slug)){
            $slug = $slug. "-" . $i++;        
        }

        return $slug;
    }

    public function slug_exist($slug)
    {
        $blog = Blogs::where("blog_slug", $slug)->first();    
        if($blog)
        {
            return true;
  
        }
       return false;
    }
}
