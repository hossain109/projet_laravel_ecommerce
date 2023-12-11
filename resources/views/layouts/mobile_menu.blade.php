<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <form action="#" method="get" class="mobile-search">
            <label for="mobile-search" class="sr-only">Search</label>
            <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search in..." required>
            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
        </form>
        
        <nav class="mobile-nav">
            <ul class="mobile-menu">
                <li class="active">
                    <a href="index.html">Home</a>
                    <ul>
                        <li><a href="index-1.html">01 - furniture store</a></li>
                    </ul>
                </li>


                    @php
                        $menus =    App\Models\Category::getRecordMenu();
                    @endphp
                    
                        @foreach ($menus as $menu)   
                         @if (!empty($menu->subcategory->count()))
                            <li>
                                <a href="{{url($menu->slug)}}">{{$menu->category}}</a>
    
                                <ul>
                                    @foreach ($menu->subcategory as $subcategory)
                                    <li><a href="{{$menu->slug.'/'.$subcategory->slug}}">{{$subcategory->subcategory}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        @endforeach
          
            </ul>
        </nav><!-- End .mobile-nav -->

        <div class="social-icons">
            <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
        </div><!-- End .social-icons -->
    </div><!-- End .mobile-menu-wrapper -->
</div><!-- End .mobile-menu-container -->