<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Yooqin\Creator\BlogCreator;
use App\Yooqin\Models\Blog;
use App\Yooqin\Decorator\BlogDecorator;
use App\Yooqin\Consts\BlogConst;
use Validator;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $blogs = Blog::findUser()->paginate(10);
        $list = BlogDecorator::transformList($blogs);

        return view('admin.blog.index')->with('list', $list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $category = BlogConst::getList();

        return view('admin.blog.create')->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        $data = BlogDecorator::transform($blog);
        $category = BlogConst::getList();

        return view('admin.blog.edit')->with('data', $data)->with('category', $category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $validator = Validator::make($request->all(),
                [
                'title' => 'required|min:2|max:100',
                'keywords' => 'required',
                'description' => 'required',
                'content' => 'required',
                ]
            );

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }

            $blog_id = app(BlogCreator::class)->create($request);
            if (!$blog_id) {
                throw new \Exception('数据创建失败');
            }

            return $this->jsonSuccess(['blog_id'=>$blog_id]);

        } catch (\Exception $e){

            return $this->jsonFailed($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->jsonFailed('api not found');		
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
        try {

            $validator = Validator::make($request->all(),
                [
                'title' => 'required|min:2|max:100',
                'keywords' => 'required',
                'description' => 'required',
                'content' => 'required',
                ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }

            $blog_id = app(BlogCreator::class)->update($request, $id);
            if (!$blog_id) {
                throw new \Exception('数据创建失败');
            }

            return $this->jsonSuccess(['blog_id'=>$blog_id]);

        } catch (\Exception $e){

            return $this->jsonFailed($e->getMessage());

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
        $blog = Blog::find($id);
        if (!$blog) {
            return $this->jsonFailed('未找到博客');		
        }

        if ($blog->user_id != Auth::id()) {
            return $this->jsonFailed('博客作者本人才能删除');		
        }

        $ret = $blog->delete();

        return $ret ? $this->jsonSuccess(['blog_id'=>$id]) : $this->jsonFailed('删除失败');	

    }
}
