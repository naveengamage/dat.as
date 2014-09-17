<a class="popupControls fancyCustomTop itop icon16" title="Back" href="#" style="display: none;"><span></span></a>
<h2>Upload Image</h2>
<div class="imageUploadError alertfield" style="display: none;"></div>
<form class="imageUpload" action="/image/upload/" method="post" enctype="multipart/form-data">
    <input type="hidden" name="ajax" value="1" />
    <div class="switcherBox"><a class="switchLeft active">from file<span></span></a><a class="switchRight">from url<span></span></a></div>
    <div class="imageUploadInput imageUploadFile correctPicture">
        <input type="file" name="files[]" class="primary inputfile" />
        <button class="siteButton bigButton botmarg10px"><span>upload</span></button>
    </div>
    <div class="imageUploadInput imageUploadUrl" style="display: none;">
        <input type="text" class="primary textinput longtextinput" name="url" value="" />
        <button class="siteButton bigButton"><span>upload</span></button>
    </div>
    <div class="indicator" style="display: none; width: 100%;">
        <span class="indicatorHackValue"></span>
        <div>
            <span class="blank"></span>
        </div>
    </div>
</form>
<span class="font10px">
    Maximum file size: 3 Mb. Allowed file types: jpg, png, bmp, gif.
</span>
<hr class="clear" />
@if(count(Auth::user()->userpics()) != 0)
<h2>Recent Uploads</h2>
<div class="imageSelector ui-selectable">
	@foreach(Auth::user()->userpics() as $userpic)
	<div class="galleryThumbSizerStills inlineblock">
        <a href="/uploads/user/{{Auth::user()->id}}/or/{{$userpic->id}}.png" data-image-id="{{$userpic->id}}" data-image-name="{{$userpic->id}}" class="galleryThumb">
            <img src="/uploads/user/{{Auth::user()->id}}/thumb/{{$userpic->id}}.png" alt="" />
        </a>
    </div> 
	@endforeach
	<div class="clear"></div>
</div>
@endif

