<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    //customer create page
    public function create(){
        // $posts = Post::orderBy('created_at','desc')->paginate(3);


  //http://localhost/todoList/public/customer/createPage?page=1&&key=cool

        $posts= Post::when(request('searchKey'),function($query){
            $key = request('searchKey');
            $query->orWhere('title','like','%'.$key.'%')
                  ->orWhere('description','like','%'.$key.'%');
        })
        ->orderBy('created_at','desc')
        ->paginate(4);

        return view('create',compact('posts'));
    }

    //post create
    public function postCreate(Request $request){
        $this->postValidationCheck($request);
        $data = $this->getPostData($request);

        if($request->hasFile('postImage')){

            $fileName = uniqid().'_' .$request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->storeAs('public',$fileName);
            $data['image'] = $fileName;

        }


        Post::create($data);
        return redirect()->route('post#createPage')->with(['insertSuccess'=>"Post ဖန်တီးခြင်းအောင်မြင်ပါသည်"]);
    }

    //post delete
    public function postDelete($id){
        //first way
        Post::where('id',$id)->delete();

        //second way
        // $post = Post::find($id)->delete();
        return back()->with(['deleteSuccess'=>"Delete လုပ်ခြင်းအောင်မြင်ပါသည်"]);
    }

    //direct update page
    public function updatePage($id){
        $post = Post::where('id',$id)->first();
        // dd($post->toArray());
        return view('update',compact('post'));
    }

    //edit page
    public function editPage($id){
        $post = Post::where('id',$id)->first()->toArray();

        return view('edit',compact('post'));
    }

    //Update Post
    public function update(Request $request){
        // dd($request->all());
        $this->postValidationCheck($request);
        $updateData = $this->getPostData($request);
        $id = $request->postId;

        if($request->hasFile('postImage')){
            //delete
            $oldImageName = Post::select('image')->where('id',$request->postId)->first()->toArray();
            $oldImageName = $oldImageName['image'];

            if($oldImageName != null){
                Storage::delete('public/'.$oldImageName);
            }

            $fileName = uniqid().'_' .$request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->storeAs('public',$fileName);
            $updateData['image'] = $fileName;

        }
        Post::where('id',$id)->update($updateData);
        return redirect()->route('post#createPage')->with(['updateSuccess'=>"Update လုပ်ခြင်းအောင်မြင်ပါသည်"]);
    }






    //get post data
    private function getPostData($request){
        $response = [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            // 'price'=>$request->postPrice,
            // 'address'=>$request->postAddress,
            // 'rating'=>$request->postRating
        ];
        $response['price']=$request->postPrice == null ? 2000 : $request->postPrice;
        $response['address']=$request->postAddress == null ? 'Yangon' : $request->postAddress;
        $response['rating']=$request->postRating == null ? 5 : $request->postRating;

        return $response;
    }

    private function postValidationCheck($request){

            $validationRules = [
            'postTitle' => 'required|min:5|unique:posts,title,'.$request->postId,
            'postDescription' => 'required|min:5',
            'postImage'=>'mimes:jpg,jpeg,png|file',
            // 'postPrice'=>'required|numeric|between:2000,50000',
            // 'postAddress'=>'required',
            // 'postRating'=>'required'
        ];



        $validationMessage = [
            'postTitle.required' => 'Post Title ဖြည့်ရန်လိုအပ်ပါသည်။',
            'postTitle.min' => 'အနည်းဆုံး ၅ လုံးအထက်ရှိရပါမည်။',
            'postTitle.unique' => 'Post Title ခေါင်းစဉ်တူနေပါသည်။ ထပ်မံရိုက်ကြည့်ပါ။',
            'postDescription.required' => 'Post Description ဖြည့်ရန်လိုအပ်ပါသည်။',
            'postDescription.min' => 'အနည်းဆုံး ၅ လုံးအထက်ရှိရပါမည်။',
            // 'postPrice.required' => 'Price ဖြည့်ရန်လိုအပ်ပါသည်။',
            // 'postPrice.between' => 'Price က2000 နှင့် 50000ကြားရှိရမည်။',
            // 'postAddress.required' => 'Address ဖြည့်ရန်လိုအပ်ပါသည်။',
            // 'postRating.required' => 'Rating ဖြည့်ရန်လိုအပ်ပါသည်။',
            'postImage.mimes' => 'Image သည် PNG JPG JPEG type သာဖြစ်ရပါမည်။',
            'postImage.file'=> 'Image သည် file type သာဖြစ်ရပါမည်။'
        ];
        Validator::make($request->all(),$validationRules,$validationMessage)->validate();
    }
}
