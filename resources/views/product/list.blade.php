@extends('layouts.app')

@section('content')
    
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            @if (!empty($subcategory))
            <h1 class="page-title">{{$subcategory->subcategory}}</h1>
            @else
            <h1 class="page-title">{{$category->category}}</h1>
            @endif
            
        </div>
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                
                @if (!empty($subcategory))
                <li class="breadcrumb-item"><a href="{{url($category->slug)}}">{{$category->category}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$subcategory->subcategory}}</li>
                @else
                <li class="breadcrumb-item active" aria-current="page">{{$category->category}}</li>
                @endif
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="toolbox">
                        <div class="toolbox-left">
                            <div class="toolbox-info">
                                Showing <span>9 of 56</span> Products
                            </div>
                        </div>

                        <div class="toolbox-right">
                            <div class="toolbox-sort">
                                <label for="sortby">Sort by:</label>
                                <div class="select-custom">
                                    <select name="sortby" id="sortby" class="form-control">
                                        <option value="popularity" selected="selected">Most Popular</option>
                                        <option value="rating">Most Rated</option>
                                        <option value="date">Date</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="products mb-3">
                        <div class="row justify-content-center">
                        @foreach ($products as $product)
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="product product-7 text-center">
                                    <figure class="product-media">

                                        @foreach ($product->image as $image)
                                        @if (!empty($image))
                                            @if ($loop->first)
                                            <a href="{{url($product->slug)}}">
                                                <img style="height: 280px;width:100%;object-fit:cover;" src="{{url('upload/images/'.$image->name)}}" alt="{{$product->title}}" class="product-image">
                                            </a>
                                            @endif   
                                        @endif
                                         @endforeach

                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                        </div>

                                        <div class="product-action">
                                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                        </div>
                                    </figure>

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="{{ url($product->category->slug.'/'.$product->subcategory->slug) }}">{{ $product->subcategory->subcategory }}</a>
                                        </div>
                                        <h3 class="product-title"><a href="{{url($product->slug)}}">{{$product->title}}</a></h3><!-- End .product-title -->
                                        <div class="product-price">
                                            {{number_format($product->price,2)}}&nbsp;$
                                        </div>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                                            </div>
                                            <span class="ratings-text">( 2 Reviews )</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    {{-- {{!! $products->appends(Illuminate\Support\Facades\Request::except('page'))->links()  !!}} --}}
                    {{ $products->links() }}
                </div>
                <aside class="col-lg-3 order-lg-first">
                    <div class="sidebar sidebar-shop">
                        <div class="widget widget-clean">
                            <label>Filters:</label>
                            <a href="#" class="sidebar-filter-clear">Clean All</a>
                        </div><!-- End .widget widget-clean -->

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                    Category
                                </a>
                            </h3>

                        @php
                            $categories =    App\Models\Category::getRecordMenu();
                        @endphp
                            <div class="collapse show" id="widget-1">
                                <div class="widget-body">
                                    <div class="filter-items filter-items-count">

                                    @foreach ($categories as $item)
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cat-1">
                                                <label class="custom-control-label" for="cat-1">{{$item->category}}</label>
                                            </div>
                                            <span class="item-count">{{$item->product()->count()}}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true" aria-controls="widget-2">
                                    Size
                                </a>
                            </h3><!-- End .widget-title -->
                            @php
                                $sizes = App\Models\ProductDetail::getProductDetails();
                               
                            @endphp
                            <div class="collapse show" id="widget-2">
                                <div class="widget-body">
                                    <div class="filter-items">
                                        @foreach ($sizes as $item)
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="{{$item->id}}">
                                                <label class="custom-control-label" for="{{$item->id}}">{{$item->name}}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true" aria-controls="widget-3">
                                    Colour
                                </a>
                            </h3>
                            @php
                                $allcolors = App\Models\Color::getActiveColors();
                            @endphp
                            <div class="collapse show" id="widget-3">
                                <div class="widget-body">
                                    <div class="filter-colors">
                                        @foreach ($allcolors as $value)
                                        <a href="#" class="" style="background: {{$value->code}};"><span class="sr-only">{{$value->name}}</span></a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                        $brands =   App\Models\Brand::getActiveBrands();   
                        @endphp
                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
                                    Brand
                                </a>
                            </h3><!-- End .widget-title -->

                            <div class="collapse show" id="widget-4">
                                <div class="widget-body">
                                    <div class="filter-items">
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="brand-1">
                                                <label class="custom-control-label" for="brand-1">Next</label>
                                            </div>
                                        </div>
                                        @foreach ($brands as $item)
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="{{$item->id}}">
                                                <label class="custom-control-label" for="{{$item->id}}">{{$item->name}}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5">
                                    Price
                                </a>
                            </h3><!-- End .widget-title -->

                            <div class="collapse show" id="widget-5">
                                <div class="widget-body">
                                    <div class="filter-price">
                                        <div class="filter-price-text">
                                            Price Range:
                                            <span id="filter-price-range"></span>
                                        </div><!-- End .filter-price-text -->

                                        <div id="price-slider"></div><!-- End #price-slider -->
                                    </div><!-- End .filter-price -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->
                    </div><!-- End .sidebar sidebar-shop -->
                </aside>
            </div>
        </div>
    </div>
</main>



@endsection