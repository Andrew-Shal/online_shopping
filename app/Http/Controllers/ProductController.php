<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Cart;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'asc')
            ->paginate(3);
        return view('dynamic_pages.products.myproducts')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (!auth()->user()->id) return redirect('admin/dashboard/products')->with('error', 'You need to be logged in to add a product');

        return view('dynamic_pages.products.create');
    }

    public function validator($req)
    {
        //validate based on schema defined
        return $this->validate($req, [
            'name' => 'string|required',
            'current_price' => 'required|numeric',
            'qty' => 'required|integer',
            'featured_photo' => 'nullable|image|max:1999',
            'filename' => 'nullable',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'string|nullable',
            'condition' => 'string|nullable',
            'return_policy' => 'string|nullable|'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //if user not logged in redirect to login page
        if (!auth()->user()->id) return redirect('/login')->with('error', 'Unauthorized access');

        //validate the request (form fields)
        $this->validator($request);

        // handle file upload
        if ($request->hasFile('featured_photo')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('featured_photo')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('featured_photo')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            //upload image
            $folder = 'public/users/' . auth()->user()->id . '/product_images';
            $path = $request->file('featured_photo')->storeAs($folder, $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage_placeholder.jpg';
        }

        //create product
        $product = new Product;
        $product->name = $request->input('name');
        $product->current_price = $request->input('current_price');
        $product->qty = $request->input('qty');
        $product->featured_photo = $fileNameToStore;
        $product->description = $request->input('description');
        $product->condition = $request->input('condition');
        $product->user_id = auth()->user()->id;
        $product->slug = $this->makeSlug($product->name);
        $product->return_policy = $request->input('return_policy');

        $data = array();


        if ($request->hasfile('filename')) {

            foreach ($request->file('filename') as $image) {
                $filenameWithExt = $image->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $folder = 'public/users/' . auth()->user()->id . '/product_images';
                $image->storeAs($folder, $fileNameToStore);
                $data[] = $fileNameToStore;
            }
        }

        $fn_create = function () use ($product, $data) {
            try {
                $product->save();

                if (!empty($data)) {
                    foreach ($data as $product_name) {
                        $product_photo = new ProductPhoto();
                        $product_photo->photo = $product_name;
                        $product_photo->product_id = $product->id;
                        $product_photo->save();
                    }
                }

                return redirect('/admin/dashboard/product')->with('success', 'Product Sucessfully Added');
            } catch (Exception $e) {
                DB::rollBack();
                $err = 'Unable to Add Product:' . $e->getMessage();
                return  redirect('admin/dashboard/product')->with('error', $err);
            }
        };

        $return = DB::transaction($fn_create);
        return $return;
    }

    /**
     * Display the specified resource.
     *
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $slug)
    {
        //
        $product = Product::where('id', $id)->where('slug', $slug)->where('user_id', auth()->user()->id)->first();

        if (!$product) return redirect()->back()->with('error', 'product not found');

        $data = [
            'product' => $product,
            'product_photos' => $product->productPhotos
        ];
        return view('dynamic_pages.products.productdetail')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id', $id)->where('user_id', auth()->user()->id)->first();

        if (!$product) return redirect()->back()->with('error', 'product not found');

        return view('dynamic_pages.products.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate the request (form fields)
        $this->validator($request);

        //create product
        $product = Product::find($id);

        // handle file upload
        if ($request->hasFile('featured_photo')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('featured_photo')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('featured_photo')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            //upload image
            $folder = 'public/users/' . auth()->user()->id . '/product_images';
            $path = $request->file('featured_photo')->storeAs($folder, $fileNameToStore);

            $product->featured_photo = $fileNameToStore;
        }


        $product->name = $request->input('name');
        $product->current_price = $request->input('current_price');
        $product->qty = $request->input('qty');
        $product->description = $request->input('description');
        $product->condition = $request->input('condition');
        $product->user_id = auth()->user()->id;
        $product->slug = $this->makeSlug($product->name);
        $product->return_policy = $request->input('return_policy');

        $data = array();


        if ($request->hasfile('filename')) {

            foreach ($request->file('filename') as $image) {
                $filenameWithExt = $image->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $folder = 'public/users/' . auth()->user()->id . '/product_images';
                $image->storeAs($folder, $fileNameToStore);
                $data[] = $fileNameToStore;
            }
        }

        $fn_create = function () use ($product, $data) {
            try {
                $product->save();

                if (!empty($data)) {
                    foreach ($data as $product_name) {
                        $product_photo = ProductPhoto::where('photo', $product_name)->get();
                        $product_photo->photo = $product_name;
                        $product_photo->product_id = $product->id;
                        $product_photo->save();
                    }
                }

                return redirect('/admin/dashboard/product')->with('success', 'Product Sucessfully updated');
            } catch (Exception $e) {
                DB::rollBack();
                $err = 'Unable to update Product:' . $e->getMessage();
                return  redirect('admin/dashboard/product')->with('error', $err);
            }
        };

        $return = DB::transaction($fn_create);
        return $return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getAddToCart(Request $request)
    {
        $product = Product::find($request->id);
        $cart = Session::has('cart') ? Session::get('cart') : null;

        if (!$cart) {
            $cart = new Cart($cart);
        }

        $cart->add($product, $product->id);

        Session::put('cart', $cart);

        var_dump($request->session()->get('cart'));
    }

    public function getCart()
    {
        if (!Session::get('cart')) {
            return view('dynamic_pages.products.getCart');
        }

        $cart = Session::get('cart');
        return view('dynamic_pages.products.getCart', [
            'products' => $cart->items,
            'totalPrice' => $cart->totalPrice
        ]);
    }

    protected function makeSlug($p_name)
    {
        $arr = explode(' ', $p_name);

        return sizeof($arr) < 1 ? implode('', $arr) : implode('-', $arr);
    }
}
