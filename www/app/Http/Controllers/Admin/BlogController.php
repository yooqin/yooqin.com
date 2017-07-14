<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Yooqin\Creator\BlogCreator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.blog.edit');
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

			$blog_id = app(Blog::class)->create($request);
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
				]
			);

			if ($validator->fails()) {
				throw new \Exception($validator->errors()->first());
			}

			$blog_id = app(Blog::class)->update($request);
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
		return $this->jsonFailed('api not found');		
    }
}
