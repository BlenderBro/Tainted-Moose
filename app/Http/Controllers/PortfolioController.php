<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PortfolioItem;
use Image;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$items = PortfolioItem::all();
        return view('index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate($request, [
            'title' 	=> 'required|unique:portfolio_items|max:140',
            'body' 		=> 'required',
			'client' 	=> 'required',
			'services' 	=> 'required',
        ]);

            $item = new PortfolioItem();
            $item->title = $request->get('title');
            $item->body = $request->get('body');
			$item->client = $request->get('client');
			$item->services = $request->get('services');
            $item->slug = str_slug($item->title);

            if($request->hasFile('featuredimg'))
            {
                $avatar = $request->file('featuredimg');
                $filename = time().'.'.$avatar->getClientOriginalExtension();
                $path = 'uploads/' .$filename;
                Image::make($avatar->getRealPath())->save($path);
                $item->featured_image = $filename;
            }
            $item->save();
            return redirect('/item/'.$item->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $item = PortfolioItem::where('slug', $slug)->first();
		return view('portfolio-item', compact('item'))->with($slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
