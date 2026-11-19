


@if($slider =slider('Front Page Slider'))

<!-- Hero Slider -->
    <section style="padding: 20px 0;">
        <div class="">
            <div id="heroSlider" class="carousel slide hero-slider" data-bs-ride="carousel" style="border-radius: 10px; overflow: hidden;">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="2"></button>
                </div>
                <div class="carousel-inner">
                    	@foreach($slider->subSliders as $i=>$slider)
                        <div class="carousel-item {{$i==0?'active':''}}">
                            <img src="{{asset($slider->image())}}" alt="Slide 1">
                            <div class="carousel-caption">
                                 @if($slider->name)  
                                  <h1>{!!$slider->name!!}</h1>
                                  @endif
                               
                                 @if($slider->description)
                                  <p>{!!$slider->description!!}</p>
                                  @endif
                                  
                                   @if($slider->seo_title && $slider->seo_description)
                                      <a href="{{$slider->seo_description}}" class="btn btn-primary me-2">{!!$slider->seo_title!!}</a>
                                   @endif
                            </div>
                        </div>
                 
                        @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#heroSlider" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroSlider" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </section>
    @endif
