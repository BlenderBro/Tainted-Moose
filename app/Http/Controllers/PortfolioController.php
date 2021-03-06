<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PortfolioItem;
use Image;

class PortfolioController extends Controller
{
	public function sendMail()
	{
		$name = strip_tags(htmlspecialchars($_POST['name']));
		$email_address = strip_tags(htmlspecialchars($_POST['email']));
		$phone = strip_tags(htmlspecialchars($_POST['phone']));
		$message = strip_tags(htmlspecialchars($_POST['message']));

		// Create the email and send the message
		$to = 'vlad.s.dobrescu@gmail.com';
		$email_subject = "Website Contact Form:  $name";
		$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
		$headers = "From: noreply@sabrinavlasceanu.com\n";
		$headers .= "Reply-To: $email_address";
		mail($to,$email_subject,$email_body,$headers);
		return true;
		}
	}
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function allItems()
    {
        $items = PortfolioItem::orderBy('updated_at', 'desc')->get();
		return view('all-items', compact('items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 public function edit(Request $request, $slug)
     {
         $item = PortfolioItem::where('slug',$slug)->first();
         return view('edit-item')->with('item',$item);
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
		$item_id = $request->input('item_id');
        $item = PortfolioItem::find($item_id);

        $title = $request->input('title');
        $slug = str_slug($title);
        $duplicate = PortfolioItem::where('slug',$slug)->first();

        if($duplicate)
        {
            if($duplicate->id != $item_id)
            {
                return redirect('/edit-item'.$item->slug)->withErrors('Title already exists.')->withInput();
            }
            else
            {
                $item->slug = $slug;
            }
        }
        $item->title = $title;
		$item->client = $request->input('client');
		$item->services = $request->input('services');
        $item->body = $request->input('body');

        if($request->hasFile('featuredimg'))
            {
                $avatar = $request->file('featuredimg');
                $filename = time().'.'.$avatar->getClientOriginalExtension();
                $path = 'uploads/' .$filename;
                Image::make($avatar->getRealPath())->save($path);
                $item->featured_image = $filename;
            }

        $item->save();

        return view('edit-item')->with('item',$item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
		$data = PortfolioItem::find($id);
        if (!is_null($data)) {
            $data->delete();
        }
        // TODO: flash something on delete

        $items = PortfolioItem::orderBy('updated_at','desc')->get();
        return view('all-items', compact('items'));
    }
}
