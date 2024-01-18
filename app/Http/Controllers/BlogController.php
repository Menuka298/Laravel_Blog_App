<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //Store Blog Function
    public function storeBlog(Request $request)
    {
        $validatedData = $request->validateWithBag('storeError',[
            'email' => 'required|email',
            'blog_Tittle' => 'required|min:6',
            'blog_description' => 'required|min:15',
            'images' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $images = [];
        if ($request->images){
            foreach($request->images as $key => $image)
            {
                $imageName = time().rand(1,99).'.'.$image->extension();
                $image->move(public_path('images'), $imageName);

                $flight = Blog::create([
                    'name' => $imageName,
                    'email' => $request ->email,
                    'blog_Tittle' => $request ->blog_Tittle,
                    'blog_description' => $request ->blog_description,
                    'deleted' => '0'
                ]);
            }
        }

        return back()
                ->with('success','You have successfully upload image.')
                ->with('images', $images);
    }

    //Show Blog Function
    public function showBlog()
    {
        $Blog_list = Blog::where('deleted', '=', '0')->paginate(5);

        return view('blog', compact('Blog_list'));
    }

    //Update Blog Function
    public function updateBlog(Request $request){

        $validated = $request->validateWithBag('updateError', [
            'email' => 'required|email',
            'blog_Tittle' => 'required',
            'blog_description' => 'required',
        ]);

        Blog::where('id',$request->id)->update([
            'email' => $request->email,
            'blog_Tittle' => $request ->blog_Tittle,
            'blog_description' => $request ->blog_description,
        ]);

        return back();
    }

    //Delete Blog Function
    public function deleteBlog(Request $request){

        Blog::where('id',$request->id)->update(['deleted' => '1']);

        return back();
    }

    // Search Blog Function
    public function searchBlog(Request $request)
    {
        $search = $request->input('search');

        $Blog_list = Blog::where('deleted', '=', '0')
            ->where(function ($query) use ($search) {
                $query->where('email', 'like', '%' . $search . '%')
                    ->orWhere('blog_Tittle', 'like', '%' . $search . '%')
                    ->orWhere('blog_description', 'like', '%' . $search . '%');
            })
            ->paginate(4);

        if ($Blog_list->isEmpty()) {
            return view('blog')->with('searchError', 'No matching items found.');
        }

        return view('blog', compact('Blog_list'));
    }
}
