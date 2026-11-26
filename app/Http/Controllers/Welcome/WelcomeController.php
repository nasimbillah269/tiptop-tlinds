<?php

namespace App\Http\Controllers\Welcome;

use Image;
use Auth;
use Hash;
use Str;
use Session;
use Carbon\Carbon;
use App\Models\Country;
use App\Models\Post;
use App\Models\Media;
use App\Models\PostExtra;
use App\Models\User;
use App\Models\Attribute;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Artisan;
use Illuminate\Support\Facades\Http;


class WelcomeController extends Controller
{
  
    public function __construct(){
        $this->middleware('cart');
    }
	public function geo_filter($id){

      $datas=Country::where('parent_id',$id)->get();
      $geoData =View('geofilter',compact('datas'))->render();
       return Response()->json([
              'success' => true,
              'geoData' => $geoData,
            ]);
    }
    
    public function imageView(Request $r){
        // Only allow image files that live inside public/ (no remote URLs, no path traversal).
        $path = null;
        if($r->imageUrl){
            $relative = ltrim(parse_url($r->imageUrl, PHP_URL_PATH) ?? '', '/');
            $relative = preg_replace('#^public/#', '', $relative);
            $real = realpath(public_path($relative));
            if($real && str_starts_with($real, realpath(public_path()).DIRECTORY_SEPARATOR)
                && preg_match('/\.(jpe?g|png|gif|webp)$/i', $real)){
                $path = $real;
            }
        }

        if($path && is_numeric($r->weight) && is_numeric($r->height)
            && $r->weight > 0 && $r->height > 0 && $r->weight <= 3000 && $r->height <= 3000){
          $image = Image::make($path)->fit((int)$r->weight,(int)$r->height)->response();
        }else{
          $image = Image::make(public_path('media/noimage.jpg'))->fit(200,200)->response();
        }
        return $image;
    }
    
    public function imageView2(Request $r,$template=null,$image=null){
        $weight=null;
        $height=null;
        if(is_numeric($r->w)){
          $weight=$r->w;  
        }
        if(is_numeric($r->h)){
          $height=$r->h;  
        }
        
        $filePath=public_path('media/profile.png');

        if($image){
            $file =Media::where('file_rename',$image)->select(['file_url'])->first();
            if($file && is_file(public_path(ltrim($file->file_url,'/')))){
                $filePath = public_path(ltrim($file->file_url,'/'));
            }
        }
        
        
     
        
        $mImage =Image::make($filePath);
        if($weight && $height){
            $mImage=$mImage->fit($weight,$height);
        }
        $mImage=$mImage->response();
        
        return $mImage;
    }
    public function siteMapXml(Request $r){
      $pages = Post::latest()->where('type',0)->where('status','active')->whereNotIn('slug',['home','cart'])->select(['slug','updated_at'])->get();
      $posts = Post::latest()->where('type',1)->where('status','active')->select(['slug','updated_at'])->get();
      $products = Post::latest()->where('type',2)->where('status','active')->select(['slug','updated_at'])->get();
      $categories = Attribute::latest()->where('type',0)->where('status','active')->whereNotNull('slug')->select(['slug','updated_at'])->get();

      return response()->view('sitemap.sitemap',compact('pages','posts','products','categories'))->header('Content-Type', 'application/xml');
    }

    public function imageSiteMapXml(Request $r){
      $items = collect();

      $slider = slider('Front Page Slider');
      if($slider){
        $images = collect();
        foreach($slider->subSliders as $slide){
          if($slide->imageFile){
            $images->push(asset(ltrim($slide->image(),'/')));
          }
        }
        $items->push(['loc'=>route('index'),'title'=>general()->title,'images'=>$images]);
      }

      $products = Post::latest()->where('type',2)->where('status','active')->with(['imageFile','galleryFiles'])->get();
      foreach($products as $product){
        $images = collect();
        if($product->imageFile){
          $images->push(asset($product->image()));
        }
        foreach($product->galleryFiles as $file){
          if($file->file_url){
            $images->push(asset($file->image()));
          }
        }
        $items->push(['loc'=>route('productView',$product->slug),'title'=>$product->name,'images'=>$images->unique()]);
      }

      $posts = Post::latest()->where('type',1)->where('status','active')->with('imageFile')->get();
      foreach($posts as $post){
        if($post->imageFile){
          $items->push(['loc'=>route('blogView',$post->slug),'title'=>$post->name,'images'=>collect([asset($post->image())])]);
        }
      }

      // Encode each path segment (file names may contain spaces) and drop duplicate slashes.
      $encode = function($url){
        $parts = parse_url($url);
        $path = implode('/', array_map('rawurlencode', array_map('rawurldecode', explode('/', preg_replace('#/+#','/',$parts['path'] ?? '')))));
        return $parts['scheme'].'://'.$parts['host'].$path;
      };
      $items = $items->map(function($item) use($encode){
        $item['images'] = $item['images']->map($encode)->unique()->values();
        return $item;
      })->filter(fn($item) => $item['images']->isNotEmpty());

      return response()->view('sitemap.imageSitemap',compact('items'))->header('Content-Type', 'application/xml');
    }

    public function llmsTxt(Request $r){
      $categories = Attribute::latest()->where('type',0)->where('status','active')->whereNotNull('slug')->get(['name','slug']);
      $products = Post::latest()->where('type',2)->where('status','active')->get(['name','slug','short_description','regular_price','final_price','running_feet']);
      $pages = Post::latest()->where('type',0)->where('status','active')->whereNotIn('slug',['home','cart'])->get(['name','slug']);

      return response()->view('sitemap.llms',compact('categories','products','pages'))->header('Content-Type', 'text/plain; charset=UTF-8');
    }

    public function productFeedXml(Request $r){
      $products = Post::latest()->where('type',2)->where('status','active')->select(['id','name','description','regular_price','final_price','slug','updated_at','status'])->limit(1000)->get();
      return response()->view('productFeedXml',compact('products'))->header('Content-Type', 'text/xml');
    }
    public function language($lang=null){
      if($lang){
          Session::put('lang',$lang);
      }else{
          Session::put('lang','en');
      }
      return redirect()->back();
    }

    public function index(Request $r){
//      Artisan::call('cache:clear');
//       Artisan::call('config:clear');
//       Artisan::call('config:cache');
//       Artisan::call('view:clear');
//       Artisan::call('route:clear');
//       Artisan::call('clear-compiled');

// return 'sucess';

        // The current home template (welcome/index) only shows the featured categories
        // and the video gallery. These collections were queried but never displayed,
        // so they are passed empty to keep the view variables available without the cost.
        $latestPosts = collect();
        $offerBanners = collect();
        $featuredCollection = collect();
        $mostSalesCollection = collect();
        $clients = collect();

        $categories =Attribute::latest()->where('type',0)->where('status','active')->where('fetured',true)->get();
        $videoGallerys =Attribute::latest()->where('type',4)->where('location','Front Page Gallery')->where('status','active')->first();
        

        
    	return view(welcomeTheme().'index',compact('latestPosts','featuredCollection','clients','videoGallerys','mostSalesCollection','offerBanners','categories'));
    }

    public function productCategory($slug){
      $category =Attribute::latest()->where('type',0)->where('slug',$slug)->first();
      if(!$category){
        return abort('404');
      }
      $products = Post::with(['imageFile','productCategories'])->latest()->whereHas('ctgProducts',function($q) use($category){
        $q->where('reff_id',$category->id);
      })
      ->where(function($qq){
        $qq->where('status','active');
      })
      //->select(['id','name','slug','addedby_id','created_at'])
      //->whereDate('created_at','<=',date('Y-m-d'))
      ->paginate(24);
        
      collect($products->items())->map(function($item){
            $item->category_name =implode(' - ', $item->productCategories->pluck('name')->toArray());
            unset($item->productCategories);
            return $item;
        });
        
      return view(welcomeTheme().'products.categoryProducts',compact('category','products'));
    }

    public function productView($slug){
      $product =Post::latest()->where('type',2)->where('slug',$slug)->first();
      if(!$product){
        return abort('404');
      }
      
      $product->category_name =implode(' - ', $product->productCategories->pluck('name')->toArray());
      unset($product->productCategories);
      
      $relatedProducts = $product->relatedProducts()->limit(4)->get();
      
      collect($relatedProducts)->map(function($item){
            $item->category_name =implode(' - ', $item->productCategories->pluck('name')->toArray());
            unset($item->productCategories);
            return $item;
        });
      
      $moreProducts = $product->relatedProducts()->inRandomOrder()->limit(4)->get();
        
        collect($moreProducts)->map(function($item){
            $item->category_name =implode(' - ', $item->productCategories->pluck('name')->toArray());
            unset($item->productCategories);
            return $item;
        });
        
      return view(welcomeTheme().'products.productView',compact('product','relatedProducts'));
      //return view(welcomeTheme().'products.productView',compact('product','relatedProducts','moreProducts'));
    }

    public function blogCategory($slug){
      $category =Attribute::latest()->where('type',6)->where('slug',$slug)->first();
      if(!$category){
        return abort('404');
      }

      $posts = $category->activePosts()->latest()
      ->select(['id','name','slug','short_description','addedby_id','created_at'])
      ->paginate(10);

      return view(welcomeTheme().'blogs.categoryPosts',compact('category','posts'));
    }

    public function blogTag($slug){
      $tag =Attribute::latest()->where('type',7)->where('slug',$slug)->first();
      if(!$tag){
        return abort('404');
      }

      $posts = Post::whereHas('tagPosts',function($q) use($tag){
        $q->where('reff_id',$tag->id);
      })
      ->where(function($qq){
        $qq->where('status','active');
      })
      ->select(['id','name','slug','short_description','addedby_id','created_at'])
      ->whereDate('created_at','<=',date('Y-m-d'))
      ->paginate(10);

      return view(welcomeTheme().'blogs.tagPosts',compact('tag','posts'));
    }

    public function blogAuthor($id,$slug){
      $author =User::find($id);
      if(!$author){
        return abort('404');
      }
      $posts =$author->posts()->latest()->where('type',1)->where('status','active')
      ->select(['id','name','slug','short_description','addedby_id','created_at'])
      ->whereDate('created_at','<=',date('Y-m-d'))
      ->paginate(10);
      return view(welcomeTheme().'blogs.authorPosts',compact('author','posts'));

    }

    public function blogView($slug){
      $post =Post::where('type',1)->where('slug',$slug)->first();
      if(!$post){
        return abort('404');
      }
      $relatedPosts =$post->relatedPosts()->limit(3)->select(['id','name','slug','short_description','addedby_id','created_at'])->get();
      $comments =$post->postComments()->where('status','active')->select(['id','name','content','created_at'])->paginate(10);
      return view(welcomeTheme().'blogs.blogView',compact('post','relatedPosts','comments'));

    }

    public function blogSearch(Request $r){
      $check = $r->validate([
          'search' => 'required|max:100',
      ]);
      
      $posts =Post::latest()->where('type',1)->where('status','active')
      ->where(function($q) use ($r) {
        if($r->search){
          $q->where('name','LIKE','%'.$r->search.'%');
        }

      })
      ->select(['id','name','slug','short_description','addedby_id','created_at'])
      ->whereDate('created_at','<=',date('Y-m-d'))
      ->paginate(10)->appends([
        'search'=>$r->search,
      ]);

      return view(welcomeTheme().'blogs.blogSearch',compact('posts','r'));

    }

    public function blogComments(Request $r,$slug){
      $post =Post::where('type',1)->where('slug',$slug)->first();
      if(!$post){
        return abort('404');
      }

      $check = $r->validate([
          'name' => 'required|max:100',
          'email' => 'required|max:100',
          'website' => 'required|max:100',
          'comment' => 'required|max:1000',
      ]);

      $comments =new Review();

      if(Auth::check()){
      $comments->addedby_id=Auth::id();
      }
      $comments->src_id=$post->id;
      $comments->type=1;
      $comments->name=$r->name;
      $comments->email=$r->email;
      $comments->website=$r->website;
      $comments->content=$r->comment;
      $comments->save();

      Session()->flash('success','Your Comments successfully Submitted.');

      return back();


    }


    public function pageView($slug){
      $page =Post::latest()->where('type',0)->where('slug',$slug)->first();

      if(!$page){
        return abort('404');
      }
      //If deferent Design or Condition Page Return by ID.
        
      //Font Home Page
      if($page->template=='Front Page'){
        return redirect()->route('index');
      }

      //Contact Us Page
      if($page->template=='Contact Us'){
        return view(welcomeTheme().'pages.contactUs',compact('page'));
      }
      
    //   //Single  Page
    //   if($page->template=='Single Page'){
    //     return view(welcomeTheme().'pages.singlePage',compact('page'));
    //   }

      //About Us Page
      if($page->template=='About Us'){
        return view(welcomeTheme().'pages.aboutUs',compact('page'));
      }
      
      
      //My Account Page
      if($page->template=='My Account'){
        return view(welcomeTheme().'pages.myAccount',compact('page'));
      }
      
      //Clients Page
      if($page->template=='All Clients'){
        return view(welcomeTheme().'pages.clients',compact('page'));
      }

      //Projects Page: photos from the "Project Gallery" gallery, videos from "Project Videos"
      if($page->template=='Projects'){
        $photoGallery =Attribute::latest()->where('type',4)->where('location','Project Gallery')->where('status','active')->first();
        $videoGallery =Attribute::latest()->where('type',4)->where('location','Project Videos')->where('status','active')->first();

        $projects =$photoGallery ? $photoGallery->galleryImages()->where('file_type','<>',5)->get() : collect();
        $videos =$videoGallery ? $videoGallery->galleryImages()->where('file_type',5)->get() : collect();

        return view(welcomeTheme().'pages.projects',compact('page','projects','videos','photoGallery'));
      }

      //Latest Blog Page
      if($page->template=='Latest Blog'){
        $posts = Post::latest()->where('type',1)->where('status','active')
        ->select(['id','name','slug','short_description','addedby_id','created_at'])
        ->whereDate('created_at','<=',date('Y-m-d'))
        ->paginate(10);
        
        $videoGallerys =Attribute::latest()->where('type',4)->where('location','Project Videos')->where('status','active')->first();
        $photoGallerys =Attribute::latest()->where('type',4)->where('location','Project Gallery')->where('status','active')->first();
        
        return view(welcomeTheme().'blogs.latestBlogs',compact('posts','page','videoGallerys','photoGallerys'));
      }

      //Latest Services Page
      if($page->template=='Latest Products'){
        $products = Post::latest()->where('type',2)->where('status','active')
        //->select(['id','name','slug','short_description','addedby_id','created_at'])
        ->whereDate('created_at','<=',date('Y-m-d'))
        ->paginate(6);
        
        collect($products->items())->map(function($item){
            $item->category_name =implode(' - ', $item->productCategories->pluck('name')->toArray());
            unset($item->productCategories);
            return $item;
        });
        
        return view(welcomeTheme().'products.latestProducts',compact('products','page'));
      }
      
      return view(welcomeTheme().'pages.pageView',compact('page'));

    }

    public function contactMail(Request $r){
      
      $check = $r->validate([
          'name' => 'required|max:100',
          'email' => 'required|max:100',
          'subject' => 'required|max:100',
          'phone' => 'nullable|max:11',
          'message' => 'nullable|max:500',
      ]);

        if(general()->mail_status && general()->mail_from_address){
            //Mail Data
            $datas =array('r'=>$r);
            $template ='mails.ContactMail';
            $toEmail =general()->mail_from_address;
            $toName =general()->mail_from_name;
            $subject ='Contact Mail Form '.general()->title;
            sendMail($toEmail,$toName,$subject,$datas,$template);
        }
        

      Session()->flash('success','Your form send successfully done. We are response as soon as possible.');
      return back();
    }

    public function search(Request $r){
      
        $products =Post::where('status','active')->where('type',2)
        ->where(function($q) use($r){
          $q->where('name','LIKE','%'.$r->search.'%');
          if($r->category){
              $category =Attribute::latest()->where('type',0)->where('slug',$r->category)->first();
              if($category){
                $q->whereHas('ctgProducts',function($q) use($category){
                    $q->where('reff_id',$category->id);
                });
              }
          }
        })
        ->paginate(24);

      return view(welcomeTheme().'products.productSearch',compact('products'));

    }

    public function subscribe(Request $r){
        $email =$r->email;
      if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $subscribe =PostExtra::latest()->where('type',1)->where('name',$email)->first();
        if(!$subscribe){
          
            $subscribe =new PostExtra();
            $subscribe->type=1;
            $subscribe->name=$email;
            $subscribe->save();
          $status=true;
          $message ='<span>Success:</span> You Are Successfully Subsribe.';
        }else{
          $status=true;
          $message ='<span>Note:</span> You Are Already Subsribe.Thank You.';
        }

      }else{
        $status=false;
        $message ='<span>Error:</span> Email Are Not validated';
      }

      if(request()->ajax()){
        
        return Response()->json([
                'success' => $status,
                'message' => $message,
              ]);
      }

      Session()->flash($status?'success':'error',$message);
      return redirect()->back();

    }





}
